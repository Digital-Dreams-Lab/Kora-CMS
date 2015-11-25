<?php
class Controller_Admin_Menus extends Controller_Admin
{

	public function action_index()
	{
		$data['menus'] = Model_Menus::find('all');
		$this->template->title = "Menus";
		$this->template->content = View::forge('admin/menus/index', $data);

	}

	public function action_view($id = null)
	{
		$data['menus'] = Model_Menus::find($id);

		$this->template->title = "Menus";
		$this->template->content = View::forge('admin/menus/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Menus::validate('create');

			if ($val->run())
			{
				$menus = Model_Menus::forge(array(
					'name' => Input::post('name'),
					'short_code' => Input::post('short_code'),
				));

				if ($menus and $menus->save())
				{
					Session::set_flash('success', e('Added menus #'.$menus->id.'.'));

					Response::redirect('admin/menus');
				}

				else
				{
					Session::set_flash('error', e('Could not save menus.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Menus";
		$this->template->content = View::forge('admin/menus/create');

	}

	public function action_edit($id = null)
	{
		$menus = Model_Menus::find($id);
		$val = Model_Menus::validate('edit');

		if ($val->run())
		{
			$menus->name = Input::post('name');
			$menus->short_code = Input::post('short_code');

			if ($menus->save())
			{
				Session::set_flash('success', e('Updated menus #' . $id));

				Response::redirect('admin/menus');
			}

			else
			{
				Session::set_flash('error', e('Could not update menus #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$menus->name = $val->validated('name');
				$menus->short_code = $val->validated('short_code');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('menus', $menus, false);
		}

		$this->template->title = "Menus";
		$this->template->content = View::forge('admin/menus/edit');

	}

	public function action_delete($id = null)
	{
		if ($menus = Model_Menus::find($id))
		{
			$menus->delete();

			Session::set_flash('success', e('Deleted menus #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete menus #'.$id));
		}

		Response::redirect('admin/menus');

	}

}
