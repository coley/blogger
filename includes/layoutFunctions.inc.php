<?php 
 
 /***********************************************************
 *  Display Login
 ***********************************************************/
 function displayLogin() {
 ?>
  
  <h2>Sign In</h2>
  
  <div id="formContainerSignIn">
  
    <form id="loginForm" name="loginForm" method="post">
      
          <div id="usernameContainer" class="fieldContainer">
              
              <label class="fieldLabel" id="lblUsername"
                  for="txtUsername">Username: </label><br />
                      
              <input type="text" id="txtUsername" name="txtUsername"
                     size="25" maxlength="25" /><br /><br />
          </div>
          
          <div id="passwordContainer" class="fieldContainer">
              
              <label class="fieldLabel" id="lblPassword"
                  for="txtPassword">Password: </label><br />
                      
              <input type="password" id="txtPassword" name="txtPassword"
                     size="25" maxlength="25" /><br /><br />
          </div>
            
          <input type="submit" name="submit" value="Sign In"
            class="formSubmissionButtons" />
      
    </form>
  </div>
    
<?php
  }
  
  /***********************************************************
  *  Display Posts
  ***********************************************************/
  function displayPosts() {                
?>
    <h2>Posts</h2>
    
    <div>Have fun adding posts to the blog and commenting on the posts
	 of other bloggers :)
    </div>

    <br />
    <input type="button" id="btnAddPost" value="add post"
           class="formSubmissionButtons" />
    
    <div id="allPostsContainer">
        <br /><br />
    </div>
    
    <div id="addPostForm" title="Add Post">
	<div class="validateTips" id="tipAddPost"></div>
        
	<form>
            <fieldset>
                    <label for="txtTitle" class="fieldLabel">Title</label><br />
                    <input type="text" id="txtTitle" maxlength="40" size="40"
                           class="text ui-widget-content ui-corner-all" />
                    <br /><br />
                    
                    <label for="txtDescription" class="fieldLabel">
                        Description</label><br />
                           
                    <textarea rows="5" cols="40" id="txtDescription"
                        maxlength="500"
                        class="text ui-widget-content ui-corner-all"></textarea>
            </fieldset>
	</form>
    </div>
    
    <div id="addCommentForm" title="Add Comment">
	<div class="validateTips" id="tipAddComment"></div>
        
	<form>
            <fieldset>
                    <label for="txtDescriptionComment" class="fieldLabel">
                        Description</label><br />
                           
                    <textarea rows="5" cols="40" id="txtDescriptionComment"
                        maxlength="500"
                        class="text ui-widget-content ui-corner-all"></textarea>
            </fieldset>
	</form>
    </div>
    
    <div id="deletePost" title="Delete Post?">
	<p><span class="ui-icon ui-icon-alert"
		 style="float:left; margin:0 7px 20px 0;"></span>
		 This post will be permanently deleted and cannot be recovered.
		 Are you sure?
	</p>
   </div>
    
    <div id="deletePostUnsuccessful" title="Delete Unsuccessful">
	<p>
	   <span class="ui-icon ui-icon-circle-check"
		 style="float:left; margin:0 7px 50px 0;"></span>
	   Delete could not be completed.  You may only delete your own posts.
	</p>
   </div>
    
   <div id="actionUnsuccessful" title="Data Error">
	<p>
	   <span class="ui-icon ui-icon-circle-check"
		 style="float:left; margin:0 7px 50px 0;"></span>
	   Data error.  Please contact system administrator.
	</p>
   </div>

<?php
  }
?>
