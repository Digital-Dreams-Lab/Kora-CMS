    <div role="tabpanel" class="tab-pane " id="default">
        <div class="col-md-12">

                                 
            <div class="form-group">
                <label class="control-label" for="form_default_lang">Default lang</label>
                
                <input class="form-control" name="default_lang" value="<?php echo Input::post('default_lang', isset($settings) ? $settings['default_lang'] : ''); ?>" type="text" id="form_default_lang" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_default_charset">Default charset</label>
                
                <input class="form-control" name="default_charset" value="<?php echo Input::post('default_charset', isset($settings) ? $settings['default_charset'] : ''); ?>" type="text" id="form_default_charset" />
            </div>
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_default_timezone">Default timezone</label>
                <select class="form-control" name="default_timezone" id="form_default_timezone">
				<?php 
					$default_timezone = Input::post('default_charset', isset($settings) ? $settings['default_timezone'] : '');

                    $regions = array(
                        'Africa' => DateTimeZone::AFRICA,
                        'America' => DateTimeZone::AMERICA,
                        'Antarctica' => DateTimeZone::ANTARCTICA,
                        'Aisa' => DateTimeZone::ASIA,
                        'Atlantic' => DateTimeZone::ATLANTIC,
                        'Europe' => DateTimeZone::EUROPE,
                        'Indian' => DateTimeZone::INDIAN,
                        'Pacific' => DateTimeZone::PACIFIC
                    );
                    $timezones = array();
                    foreach ($regions as $name => $mask)
                    {
                        $zones = DateTimeZone::listIdentifiers($mask);
                        foreach($zones as $timezone)
                        {
                            // Lets sample the time there right now
                            $time = new DateTime(NULL, new DateTimeZone($timezone));
                            // Us dumb Americans can't handle millitary time
                            $ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
                            // Remove region name and add a sample time
                            $timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ' - ' . $time->format('H:i') . $ampm;
                        }
                    }
                    // View
                    foreach($timezones as $region => $list)
                    {
                        print '<optgroup label="' . $region . '">' . "\n";
                        foreach($list as $timezone => $name)
                        {
                            print '<option value="' . $timezone . '" '.($default_timezone==$timezone ? 'selected="selected"': '').'>' . $name . '</option>' . "\n";
                        }
                        print '<optgroup>' . "\n";
                    }
                ?>
				</select>
            </div>                   
                                
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_default_date_format">Default date format</label>
                
                <input class="form-control" name="default_date_format" value="<?php echo Input::post('default_date_format', isset($settings) ? $settings['default_date_format'] : ''); ?>" type="text" id="form_default_date_format" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_default_time_format">Default time format</label>
                
                <input class="form-control" name="default_time_format" value="<?php echo Input::post('default_time_format', isset($settings) ? $settings['default_time_format'] : ''); ?>" type="text" id="form_default_time_format" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_default_page_theme">Default page theme</label>
                
                <input class="form-control" name="default_page_theme" value="<?php echo Input::post('default_page_theme', isset($settings) ? $settings['default_page_theme'] : ''); ?>" type="text" id="form_default_page_theme" />
            </div>
                                           
                        
        </div>
    </div>