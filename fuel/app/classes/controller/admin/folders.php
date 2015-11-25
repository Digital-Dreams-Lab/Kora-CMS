<?php
class Controller_Admin_Folders extends Controller_Admin
{

	public function action_index()
	{
		$data['folders'] = Model_Folder::find('all');
		$this->template->title = "Folders";
		$this->template->content = View::forge('admin/folders/index', $data);

	}

	public function action_view($id = null)
	{
		$data['folder'] = Model_Folder::find($id);

		$this->template->title = "Folder";
		$this->template->content = View::forge('admin/folders/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Folder::validate('create');

			if ($val->run())
			{
				$folder = Model_Folder::forge(array(
					'parent_id' => Input::post('parent_id'),
					'order' => Input::post('order'),
					'active' => Input::post('active'),
					'base' => Input::post('base'),
					'name' => Input::post('name'),
					'description' => Input::post('description'),
				));

				if ($folder and $folder->save())
				{
					Session::set_flash('success', e('Added folder #'.$folder->id.'.'));

					Response::redirect('admin/folders');
				}

				else
				{
					Session::set_flash('error', e('Could not save folder.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Folders";
		$this->template->content = View::forge('admin/folders/create');

	}

	public function action_edit($id = null)
	{
		$folder = Model_Folder::find($id);
		$val = Model_Folder::validate('edit');

		if ($val->run())
		{
			$folder->parent_id = Input::post('parent_id');
			$folder->order = Input::post('order');
			$folder->active = Input::post('active');
			$folder->base = Input::post('base');
			$folder->name = Input::post('name');
			$folder->description = Input::post('description');

			if ($folder->save())
			{
				Session::set_flash('success', e('Updated folder #' . $id));

				Response::redirect('admin/folders');
			}

			else
			{
				Session::set_flash('error', e('Could not update folder #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$folder->parent_id = $val->validated('parent_id');
				$folder->order = $val->validated('order');
				$folder->active = $val->validated('active');
				$folder->base = $val->validated('base');
				$folder->name = $val->validated('name');
				$folder->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('folder', $folder, false);
		}

		$this->template->title = "Folders";
		$this->template->content = View::forge('admin/folders/edit');

	}

	public function action_delete($id = null)
	{
		if ($folder = Model_Folder::find($id))
		{
			$folder->delete();

			Session::set_flash('success', e('Deleted folder #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete folder #'.$id));
		}

		Response::redirect('admin/folders');

	}

}
