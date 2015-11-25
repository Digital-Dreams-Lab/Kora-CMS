<?php
class Controller_Admin_Blocks extends Controller_Admin
{

	public function action_index()
	{
		$data['blocks'] = Model_Block::find('all');
		$this->template->title = "Blocks";
		$this->template->content = View::forge('admin/blocks/index', $data);

	}

	public function action_view($id = null)
	{
		$data['block'] = Model_Block::find($id);

		$this->template->title = "Block";
		$this->template->content = View::forge('admin/blocks/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Block::validate('create');

			if ($val->run())
			{
				$block = Model_Block::forge(array(
					'name' => Input::post('name'),
					'short_code' => Input::post('short_code'),
				));

				if ($block and $block->save())
				{
					Session::set_flash('success', e('Added block #'.$block->id.'.'));

					Response::redirect('admin/blocks');
				}

				else
				{
					Session::set_flash('error', e('Could not save block.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Blocks";
		$this->template->content = View::forge('admin/blocks/create');

	}

	public function action_edit($id = null)
	{
		$block = Model_Block::find($id);
		$val = Model_Block::validate('edit');

		if ($val->run())
		{
			$block->name = Input::post('name');
			$block->short_code = Input::post('short_code');

			if ($block->save())
			{
				Session::set_flash('success', e('Updated block #' . $id));

				Response::redirect('admin/blocks');
			}

			else
			{
				Session::set_flash('error', e('Could not update block #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$block->name = $val->validated('name');
				$block->short_code = $val->validated('short_code');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('block', $block, false);
		}

		$this->template->title = "Blocks";
		$this->template->content = View::forge('admin/blocks/edit');

	}

	public function action_delete($id = null)
	{
		if ($block = Model_Block::find($id))
		{
			$block->delete();

			Session::set_flash('success', e('Deleted block #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete block #'.$id));
		}

		Response::redirect('admin/blocks');

	}

}
