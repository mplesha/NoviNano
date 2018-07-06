<?php
  
  // Gallery effects
  $effects = array(
      'effect-1'=>'Down top Swipe-in',
      'effect-2'=>'Down top slide',
      'effect-3'=>'Back to front',
      'effect-4'=>'Top down partial flip',
      'effect-5'=>'Side flip',
      'effect-6'=>'Left right drift'
  );
?>

<html>
<head>
  <?php // This page will be loaded by template redirect as a TinyMCE plugin page
    wp_head();
  ?>
</head>
<body>
  <form>
    <fieldset class="closify-tinymce-fieldset">
        <legend><strong>(Step 1)</strong>:Choose Gallery Effects</legend>
          <select id="closify-effect" class="closify-tinymce-select">
            <?php 
              foreach($effects as $key=>$effect)
              {
                echo '<option value="'.$key.'">'.$effect.'</option>';
              }
            ?>
          </select>
    </fieldset>
    <br>
    <fieldset class="closify-tinymce-fieldset">
        <legend><strong>(Step 2)</strong>:Gallery Options</legend>
          <label style="margin-left:10px;">Disable caption:</label>
          <input id="disable-caption" class="closify-caption" type="checkbox">
    </fieldset>
    
    <br>
    
    <?php
    
    // Print posts table
      $table_id1 = "closifyPostTable";
      $post_table = new FlexiCustomPostTableList('3', CLOSIFY_POST_TYPE, 100, 1, $table_id1);
      $post_table->BuildTable();
    ?>
    
    <br>
    
    <?php
    
      $table_id2 = "userRolesPostTable";
    
      $roles_table = new FlexiUserRoleTableList('4', $table_id2);
      $roles_table->BuildTable();
    
    ?>
    
    <?php
    // Print users table  
      $table_id3 = "usersPostTable";
      $post_table = new FlexiUserTableList('5', $table_id3, '');
      $post_table->BuildTable();
    ?>
    
    <button class="closify-tinymce-button" onclick="insert()">Insert</button>
  </form>

   <script type="text/javascript">
    var closifyPostTable = jQuery('#<?php echo $table_id1;?>').DataTable();
    var userRolesPostTable = jQuery('#<?php echo $table_id2;?>').DataTable();
    var usersPostTable = jQuery('#<?php echo $table_id3;?>').DataTable();
        
    jQuery(document).ready(function(){
        
        function clear_all(tableName)
        {
          var rows = tableName.rows({ 'search': 'applied' }).nodes();
          jQuery('input[type="checkbox"]', rows).prop('checked', false);
        }

        function check_all(tableName)
        {
          var rows = tableName.rows({ 'search': 'applied' }).nodes();
          jQuery('input[type="checkbox"]', rows).prop('checked', true);
        }
    
        jQuery('input[type="checkbox"]').click(function(el){
            if(jQuery('.all_posts').is(":checked")){
              check_all(closifyPostTable);
            }
            else if(el.toElement.className == 'all_posts'){
              clear_all(closifyPostTable);
            }
            
            if(jQuery('.all_users').is(":checked")){
                check_all(usersPostTable);
            }
            else if(el.toElement.className == 'all_users'){
                clear_all(usersPostTable);
            }
            
            if(jQuery('.all_roles').is(":checked")){
                check_all(userRolesPostTable);
            }
            else if(el.toElement.className == 'all_roles'){
                clear_all(userRolesPostTable);
            }
        });
        
    });
    
    function insert()
    {
      shortCodeOpen = '[closify-collage ';
      postIDs = 'closify_ids="';
      effect = 'effect="';
      roles = 'roles="';
      users = 'user_ids="';
      captions = 'disable_caption=';
      
      // insert closify ids
      closifyPostTable.$('input[type="checkbox"]').each(function () {
           if (this.checked && this.className == "posts") {
               postIDs = postIDs + jQuery(this).val() +","; 
           }
      });
      
      // Caption
      if (jQuery('input.closify-caption').is(':checked')) {
        captions = captions + '"' + jQuery('input.closify-caption').val() + '"';
      }else{
        captions = '';
      }
      
      // remove last extra comma
      // remove last extra comma
      if(postIDs != 'closify_ids="'){
        postIDs = postIDs.substring(0, postIDs.length - 1);
        postIDs = postIDs + '" ';
      }else{
        postIDs = '';
      }

      
      // Parse the selected effect
      effect = effect + jQuery( "#closify-effect option:selected" ).val();
      effect = effect + '" '
      
      // insert roles
      userRolesPostTable.$('input[type="checkbox"]').each(function () {
           if (this.checked && this.className == "roles") {
               roles = roles + jQuery(this).val() +","; 
           }
      });
      
      // insert user ids
      usersPostTable.$('input[type="checkbox"]').each(function () {
           if (this.checked && this.className == "users") {
               users = users + jQuery(this).val() +","; 
           }
      });
      
      // remove last extra comma
      if(users != 'user_ids="'){
        users = users.substring(0, users.length - 1);
        users = users + '" ';
      }else{
        users='';
      }
      
      // remove last extra comma
      if(roles != 'roles="'){
        roles = roles.substring(0, roles.length - 1);
        roles = roles + '" ';
      }else{
        roles='';
      }
      
      parent.insert_data(shortCodeOpen+postIDs+effect+users+roles+captions+']');
      parent.tinyMCE.activeEditor.windowManager.close(window);
    }
    
  </script>
</body>