<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Archivo;

class Archivos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $file_name, $file_extension;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.archivos.view', [
            'archivos' => Archivo::latest()
						->orWhere('file_name', 'LIKE', $keyWord)
						->orWhere('file_extension', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->file_name = null;
		$this->file_extension = null;
    }

    public function store()
    {
        $this->validate([
		'file_name' => 'required',
		'file_extension' => 'required',
        ]);

        Archivo::create([ 
			'file_name' => $this-> file_name,
			'file_extension' => $this-> file_extension
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Archivo Successfully created.');
    }

    public function edit($id)
    {
        $record = Archivo::findOrFail($id);
        $this->selected_id = $id; 
		$this->file_name = $record-> file_name;
		$this->file_extension = $record-> file_extension;
    }

    public function update()
    {
        $this->validate([
		'file_name' => 'required',
		'file_extension' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Archivo::find($this->selected_id);
            $record->update([ 
			'file_name' => $this-> file_name,
			'file_extension' => $this-> file_extension
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Archivo Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Archivo::where('id', $id)->delete();
        }
    }
}