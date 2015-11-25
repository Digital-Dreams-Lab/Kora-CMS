			<?php if (Input::method() === 'POST'): ?>
                <?php 
                    
                    $post_new['form_data'][] = $post;
                    $post_new['form_settings'] = '';
                    $output = Plugin_Form_Edit::forge($post_new);
                
                    foreach ($output as $input):
                        echo $input."\n";
                    endforeach;						
                
                ?>
            <?php endif; //*/ ?>