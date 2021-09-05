<div class="row">
  <div class="col-md-4">
    <h4><?=trans('personal_info')?></h4>
    <table class="table">
      <tr>
        <td><?=trans('full_name')?></td>
        <td><?= $user_info['firstname'].' '.$user_info['lastname']  ?></td>
      </tr>
      <tr>
        <td><?=trans('email')?></td>
        <td><?= $user_info['email']  ?></td>
      </tr>
      <tr>
        <td><?=trans('phone')?></td>
        <td><?= $user_info['mobile_no']  ?></td>
      </tr>
      <tr>
        <td><?=trans('dob')?></td>
        <td><?= date('d M, Y',strtotime($user_info['dob']))  ?></td>
      </tr>

      <tr>
        <td><?=trans('category')?></td>
        <td><?= $user_info['category']  ?></td>
      </tr>

      <tr>
        <td><?=trans('user_job_title')?></td>
        <td><?= $user_info['job_title']  ?></td>
      </tr>

      <tr>
        <td><?=trans('experience')?></td>
        <td><?= $user_info['experience']  ?></td>
      </tr>

      <tr>
        <td><?=trans('skills')?></td>
        <td><?= $user_info['skills']  ?></td>
      </tr>

      <tr>
        <td><?=trans('cur_salary')?> (<?= $this->general_settings['currency']; ?>)</td>
        <td><?= $user_info['current_salary']  ?></td>
      </tr>

      <tr>
        <td><?=trans('expected_salary')?> (<?= $this->general_settings['currency']; ?>)</td>
        <td><?= $user_info['expected_salary']  ?></td>
      </tr>

      <tr>
        <td><?=trans('nationality')?></td>
        <td><?= $user_info['nationality']  ?></td>
      </tr>

      <tr>
        <td><?=trans('country')?></td>
        <td><?= $user_info['country']  ?></td>
      </tr>

      <tr>
        <td><?=trans('city_town')?></td>
        <td><?= $user_info['city']  ?></td>
      </tr>

      <tr>
        <td><?=trans('postcode')?></td>
        <td><?= $user_info['postcode']  ?></td>
      </tr>

      <tr>
        <td><?=trans('address')?></td>
        <td><?= $user_info['address']  ?></td>
      </tr>

      <tr>
        <td><?=trans('objective')?></td>
        <td><?= $user_info['description']  ?></td>
      </tr>
    </table>
  </div>

  <div class="col-md-4">
    <h4><?=trans('education')?></h4>

    <?php foreach($education as $edu): ?>
    <!-- education detail -->
    <div class="employer-job-list">
      <h5><?= get_education_level($edu['degree']).', '.$edu['degree_title'] ?></h5>
      <p><?= $edu['institution'] ?><br> <?= $edu['completion_year'] ?></p>
    </div>
    <?php endforeach; ?>
    <!-- education detail -->
  </div>

  <div class="col-md-4">
    <h4><?=trans('experience')?></h4>
    <?php foreach($experiences as $exp): ?>
    <!-- education detail -->
      <div class="employer-job-list">
        <h5><?= $exp['job_title'] ?></h5>
        <p><?= $exp['business'] ?></p>
        <p><?= get_nth_month($exp['starting_month']) .' '.$exp['starting_year']?> - <?= (!$exp['currently_working_here']) ? get_nth_month($exp['ending_month']) .' '.$exp['ending_year'] : 'Present ' ?> | <?= get_city_name($exp['city']).', '.get_country_name($exp['country']) ?></p>
        <p class="overflow-ellipsis"><?= $exp['description'] ?></p>
      </div>
    <?php endforeach; ?>
    <!-- education detail -->

  </div>

  <div class="col-md-4">
    
    <h4><?=trans('languages')?></h4>
    <?php foreach($languages as $lang): ?>
    <!-- education detail -->
      <div class="employer-job-list">
        <p><?= get_language_name($lang['language']).' ( '.get_lang_proficiency_name($lang['proficiency']).' ) ' ?></p>
      </div>
    <?php endforeach; ?>
    <!-- education detail -->
  </div>

</div>
