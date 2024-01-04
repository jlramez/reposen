<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sentencia;

class Sentencias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $archivos_id, $users_id, $archivo;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.sentencias.view', [
            'sentencias' => Sentencia::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('archivos_id', 'LIKE', $keyWord)
						->orWhere('users_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->archivos_id = null;
		$this->users_id = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		
        ]);

        Sentencia::create([ 
			'nombre' => $this-> nombre,
			'archivos_id' => $this-> archivos_id,
			'users_id' => $this-> users_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Sentencia Successfully created.');
    }

    public function edit($id)
    {
        $record = Sentencia::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->archivos_id = $record-> archivos_id;
		$this->users_id = $record-> users_id;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		
        ]);

        if ($this->selected_id) {
			$record = Sentencia::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'archivos_id' => $this-> archivos_id,
			'users_id' => $this-> users_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Sentencia Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Sentencia::where('id', $id)->delete();
        }
    }

    public function attach($id)
    {
        $record = Sentencia::findOrFail($id);
        $this->selected_id = $id; 

    }
    public function save()
    {
        $this->validate(
            [
                'archivo.*' => 'required|mimes:pdf',
            ]);
       // dd($this->archivos);
       // foreach($this->archivos as $key=>$file)
        //{
		if ($this->archivo)
			{	
					$sentencia=sentencia::find($this->selected_id);
					//$folio=$promocion->folio;
					$year=carbon::parse(now())->format('Y');
					$file_save=new Archivo();
					$file_save->file_name=$this->archivo->getClientOriginalName();
					$file_save->file_extension=$this->archivo->extension();
					$path=$this->archivo->store('sentencias/');			
					$file_save->file_path='storage/'.$path;
					$file_save->save();
					$archivo_id=Archivo::find(Archivo::max('id'))->id;
					//dd($archivo_id);
					if($archivo_id)
					{
						$sentencia->archivos_id= $archivo_id;
						$sentencia->users_id= auth()->user()->id;
						$sentencia->save(); 
						
						$this->archivo=null;
						session()->flash('message', 'Archivo adjuntado correctamente.');
						return redirect()->route('promociones.index');
					}
					else
					{
						session()->flash('message', 'ERROR !! Archivo No adjuntado .');
						return redirect()->route('promociones.index');
						
						$this->archivo=null;

					}
			}
			else
					{
						session()->flash('message', 'ERROR !! Archivo No adjuntado .');
						return redirect()->route('promociones.index');
						
						$this->archivo=null;

					}
    }
}