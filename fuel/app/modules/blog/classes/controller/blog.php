<?php

namespace Blog; 

class Controller_Blog extends Controller_Base
{
 
    public function action_index()
    {
        $data["subnav"] = array('edit'=> 'active');
        $this->template->title = 'Blog';
        $this->template->content = \View::forge('index', $data);
    }
 
    public function action_edit()
    {
        $data["subnav"] = array('edit'=> 'active');
        $this->template->title = 'Comments &raquo; Edit';
        $this->template->content = \View::forge('edit', $data);
    }
 
    public function action_create()
    {
		if (\Input::method() == 'POST')
		{
			$val = \Validation::factory();
	 
			// Add a field for title, give it the label "Title" and make it required
			$val->add('title', 'Title')
				->add_rule('required');
	 
			// Now add another field for summary, and require it to contain at least 10 and at most 250 characters
			$val->add('summary', 'Summary')
				->add_rule('required')
				->add_rule('min_length', 10)
				->add_rule('max_length', 250);
	 
			$val->add('body', 'Article body')
				->add_rule('required');
	 
			if ($val->run())
			{
				// Make a post based on the input (array)
				$post = \Model_Post::factory($val->validated());
	 
				// Try and save it
				if ($post->save())
				{
					\Session::set_flash('notice', 'Added post #' . $post->id . '.');
				}
				else
				{
					\Session::set_flash('notice', 'Could not save post.');
				}
				 
				\Response::redirect('posts');
			}
			else
			{
				$this->template->set('error', $val->errors());
			}
		}
	 
		$this->template->title = "Posts";
		$this->template->content = \View::forge('posts/_form');
    }
 
}
