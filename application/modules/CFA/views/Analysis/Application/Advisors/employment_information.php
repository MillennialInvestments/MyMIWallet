<div class="<?php e($controlGroup); ?> <?php echo form_error('industry') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="industry">Industry</label>
    <div class="<?php e($controlClass); ?> ">
        <select name="industry" class="<?php echo $controlInput; ?>" id="industry" required="required" style="height: 40px; padding: 10px;">
            <?php
                $industry_values                            = array(
                    'N/A'                                   => 'Select-An-Industry',
                    'Accommodation and Food Services'       => 'Accommodation and Food Services',
                    'Administrative'                        => 'Agriculture/Forestry',
                    'Agriculture/Forestry'                  => 'Agriculture/Forestry',
                    'Arts/Entertainment'                    => 'Arts/Entertainment',
                    'Construction'                          => 'Construction',
                    'Educational'                           => 'Educational',
                    'Finance/Insurance'                     => 'Finance/Insurance',
                    'Health'                                => 'Health',
                    'Information Technology'                => 'Information Technology',
                    'Management'                            => 'Management',
                    'Manufacturing'                         => 'Manufacturing',
                    'Oil/Gas'                               => 'Oil/Gas',
                    'Other Services'                        => 'Other Services',
                    'Professional Services'                 => 'Professional Services',
                    'Public Administration'                 => 'Public Administration',
                    'Real Estate'                           => 'Real Estate',
                    'Retail'                                => 'Retail',
                    'Transportation/Warehousing'            => 'Transportation/Warehousing',
                    'Utilities'                             => 'Utilities',
                    'Wholesale'                             => 'Wholesale'
                );
                foreach ($industry_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('industry')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('occupation') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="occupation">Occupation</label>
    <div class="<?php e($controlClass); ?> ">
        <input class="<?php e($controlInput); ?>" type="text" id="occupation" name="occupation" value="<?php echo set_value('occupation', isset($user) ? $user->occupation : ''); ?>" />
        <span class="help-inline"><?php echo form_error('occupation'); ?></span>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('employer') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="employer">Employer</label>
    <div class="<?php e($controlClass); ?> ">
        <input class="<?php e($controlInput); ?>" type="text" id="employer" name="employer" value="<?php echo set_value('employer', isset($user) ? $user->employer : ''); ?>" />
        <span class="help-inline"><?php echo form_error('employer'); ?></span>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('certification') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="certification">CFA Certification</label>
    <div class="<?php e($controlClass); ?> ">
        <select name="certification" class="<?php echo $controlInput; ?>" id="certification" required="required" style="height: 40px; padding: 10px;">
            <?php
                $certification_values                            = array(
                    'N/A'                                   => 'Select Certification',
                    'CAIA'                                  => 'CAIA (Chartered Alternative Investment Analyst)',
                    'CFA'                                   => 'CFA (Chartered Financial Advisor)',
                    'CFP'                                   => 'CFP (Certified Financial Planner)',
                    'CIMA'                                  => 'CIMA (Certified Investment Management Analyst)',
                    'FRM'                                   => 'FRM (Financial Risk Manager)',
                );
                foreach ($certification_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('certification')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('education') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="education">Education</label>
    <div class="<?php e($controlClass); ?> ">
        <select name="education" class="<?php echo $controlInput; ?>" id="education" required="required" style="height: 40px; padding: 10px;">
            <?php
                $education_values                           = array(
                    'N/A'                                   => 'Select Education',
                    'High-School Diploma'                   => 'High-School Diploma', 
                    'Associates Degree'                     => 'Associates Degree',
                    'Bachelor Degree'                       => 'Bachelor Degree',
                    'Doctorate Degree'                      => 'Doctorate Degree', 
                );
                foreach ($education_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('education')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('experience') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="experience">Years of Experience</label>
    <div class="<?php e($controlClass); ?> ">
        <select name="experience" class="<?php echo $controlInput; ?>" id="experience" required="required" style="height: 40px; padding: 10px;">
            <?php
                $experience_values                          = array(
                    'N/A'                                   => 'Select Experience',
                    'Less than 1 year'                      => 'Less than 1 year',
                    '1-2 years'                             => '1-2 years',
                    '3-5 years'                             => '3-5 years',
                    '6-10 years'                            => '6-10 years',
                    '11-15 years'                           => '11-15 years',
                    '16-20 years'                           => '16-20 years',
                    '21-25 years'                           => '21-25 years',
                    '26-30 years'                           => '26-30 years',
                    '31-35 years'                           => '31-35 years',
                    '36-40 years'                           => '36-40 years',
                    '41-45 years'                           => '41-45 years',
                    '46-50 years'                           => '46-50 years',
                    'More than 50 years'                    => 'More than 50 years'
                );
                foreach ($experience_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('experience')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('income') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="income">Income</label>
    <div class="<?php e($controlClass); ?> ">
        <select name="income" class="<?php echo $controlInput; ?>" id="income" required="required" style="height: 40px; padding: 10px;">
            <?php
                $income_values                              = array(
                    'N/A'                                   => 'Select-An-Income',
                    'Less than $50,000'                     => 'Less than $50,000',
                    '$50,000 - $74,999'                     => '$50,000 - $74,999',
                    '$75,000 - $99,999'                     => '$75,000 - $99,999',
                    '$100,000 - $124,999'                   => '$100,000 - $124,999',
                    '$125,000 - $149,999'                   => '$125,000 - $149,999',
                    '$150,000 - $174,999'                   => '$150,000 - $174,999',
                    '$175,000 - $199,999'                   => '$175,000 - $199,999',
                    '$200,000 - $249,999'                   => '$200,000 - $249,999',
                    '$250,000 - $299,999'                   => '$250,000 - $299,999',
                    '$300,000 or more'                      => '$300,000 or more'
                );
                foreach ($income_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('income')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('employment_duration') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="employment_duration">Employment Duration</label>
    <div class="<?php e($controlClass); ?> ">
        <select name="employment_duration" class="<?php echo $controlInput; ?>" id="employment_duration" required="required" style="height: 40px; padding: 10px;">
            <?php
                $duration_values                            = array(
                    'N/A'                                   => 'Select-A-Duration',
                    'Less than 1 year'                      => 'Less than 1 year',
                    '1-2 years'                             => '1-2 years',
                    '2-5 years'                             => '2-5 years',
                    '5-10 years'                            => '5-10 years',
                    '10-15 years'                           => '10-15 years',
                    '15-20 years'                           => '15-20 years',
                    '20-25 years'                           => '20-25 years',
                    '25 years or more'                      => '25 years or more'
                );
                foreach ($duration_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('employment_duration')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('expected_retirement_age') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="expected_retirement_age">Retirement Age <small>(Expected)</small></label>
    <div class="<?php e($controlClass); ?> ">
        <select name="expected_retirement_age" class="<?php echo $controlInput; ?>" id="expected_retirement_age" required="required" style="height: 40px; padding: 10px;">
            <?php
                $type_values = array(
                    '0' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                    '16' => '16',
                    '17' => '17',
                    '18' => '18',
                    '19' => '19',
                    '20' => '20',
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '24' => '24',
                    '25' => '25',
                    '26' => '26',
                    '27' => '27',
                    '28' => '28',
                    '29' => '29',
                    '30' => '30',
                    '31' => '31',
                    '32' => '32',
                    '33' => '33',
                    '34' => '34',
                    '35' => '35',
                    '36' => '36',
                    '37' => '37',
                    '38' => '38',
                    '39' => '39',
                    '40' => '40',
                    '41' => '41',
                    '42' => '42',
                    '43' => '43',
                    '44' => '44',
                    '45' => '45',
                    '46' => '46',
                    '47' => '47',
                    '48' => '48',
                    '49' => '49',
                    '50' => '50',
                    '51' => '51',
                    '52' => '52',
                    '53' => '53',
                    '54' => '54',
                    '55' => '55',
                    '56' => '56',
                    '57' => '57',
                    '58' => '58',
                    '59' => '59',
                    '60' => '60',
                    '61' => '61',
                    '62' => '62',
                    '63' => '63',
                    '64' => '64',
                    '65' => '65',
                    '66' => '66',
                    '67' => '67',
                    '68' => '68',
                    '69' => '69',
                    '70' => '70',
                    '71' => '71',
                    '72' => '72',
                    '73' => '73',
                    '74' => '74',
                    '75' => '75',
                    '76' => '76',
                    '77' => '77',
                    '78' => '78',
                    '79' => '79',
                    '80' => '80',
                    '81' => '81',
                    '82' => '82',
                    '83' => '83',
                    '84' => '84',
                    '85' => '85',
                    '86' => '86',
                    '87' => '87',
                    '88' => '88',
                    '89' => '89',
                    '90' => '90',
                    '91' => '91',
                    '92' => '92',
                    '93' => '93',
                    '94' => '94',
                    '95' => '95',
                    '96' => '96',
                    '97' => '97',
                    '98' => '98',
                    '99' => '99',
                );
                foreach ($type_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('expected_retirement_age')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
    </div>
</div>