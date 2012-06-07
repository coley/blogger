 /**************************************************************
 *  Function runs at page load.  It suppresses the display
 *  of the addPostForm, addCommentForm, deletePostForm,
 *  actionUnsuccessful form, and deletePostUnsuccessful form
 *  from the UI display. It adds click events to the form delete
 *  and comment add buttons.  It calls a function to
 *  display all posts.
 **************************************************************/
   $(document).ready(function() {
    
      $("#addPostForm").css("display", "none");
      $("#addCommentForm").css("display", "none");
      $("#deletePost").css("display", "none");
      $("#deletePostUnsuccessful").css("display", "none");
      $("#actionUnsuccessful").css("display", "none");
      $("#btnAddPost").click(addPost);
    
      $(".formDeleteButtons").live("click", function() {
         deletePost($(this));
      })
    
      $(".formCommentButtons").live("click", function() {
         addComment($(this));
      })
    
      displayAllPosts();
   })

   /**************************************************************
   *  Set global variable to user id logged into the session. This
   *  call is made synchronously within the function so that
   *  the session user id can be returned by the function.
   **************************************************************/
   var userIdInSession = (function getUserIdInSession() {
   
      var userIdInSession = '';
          
      $.ajax({
         "url": "services/userIdInSession.php",
         "success": function(response) {
            if (response.length > 0) {
               userIdInSession = response;
            }
         },
         "error":function() {
            
            $("#actionUnsuccessful").dialog({
                  "modal": true,
                  "buttons": {
                     "Ok": function() {
			$( this ).dialog( "close" );
                     }
                  }
            });
            
         },
         "async": false
      })

      return userIdInSession;
   
   })();

   /**************************************************************
   *  Function returns the user id of a given post. This
   *  call is made synchronously so that the session user id
   *  can be returned by the function.
   **************************************************************/
   function getUserIdOfPost(inputPostId) {
   
      var userIdOfPost = '';
          
      $.ajax({
         "url": "services/postById.php",
         "data": {"postId": inputPostId},
         "success": function(jsonResponse) {
                       
            $(jsonResponse).each(function(index, element) {
               userIdOfPost = element.user_id;                            
            })
         },
         "error":function() {

            $("#actionUnsuccessful").dialog({
                  "modal": true,
                  "buttons": {
                     "Ok": function() {
			$( this ).dialog( "close" );
                     }
                  }
            });
         },
         "dataType":"json",
         "async": false
      }) 

      return userIdOfPost;
   
   }


   /**************************************************************
   *  Function displays all posts. It also calls functions to
   *  add the comments section to each post and display all
   *  comments for each post.
   **************************************************************/
   function displayAllPosts() {
           
      $.ajax({
         "url": "services/allPosts.php",
         "success": function(jsonResponse) {
                       
            $(jsonResponse).each(function(index, element) {
            
               var postId = element.id;
               var postTitle = element.title;
               var postDescription = element.description;
               var postCreated = element.created;
               var postUserId = element.user_id;
                                
               var aPost = formatPost(postTitle, postDescription, postCreated,
                                       postUserId, postId);
                            
               $("#allPostsContainer").prepend(aPost);
                                
               //Add comments section
               addCommentSection(postId);
                
               //Display all post comments
               displayCommentsByPostId(postId);

            })
           
         },
         "error":function() {

            $("#actionUnsuccessful").dialog({
                  "modal": true,
                  "buttons": {
                     "Ok": function() {
			$( this ).dialog( "close" );
                     }
                  }
            });
            
         }, 
         "dataType":"json"
      })       
   }

   /**************************************************************
   *  Function adds comments container with add comment button
   **************************************************************/
   function addCommentSection(postId) {
                                
      var commentContainer = $("<div class='commentContainer'>");
                                              
      var commentHeadingContainer = $("<div class='commentHeadingContainer'>");
                                              
      var commentHeading = $("<h4>comments</h4>");

      var commentButton = $("<input type='button' value='add comment' "
                             + "class='formCommentButtons'"
                             + "id='btnAddCommentPost[" + postId + "]' />");
      
      var noCommentsContainer = $("<div class='noteNoComments'>");
      
      var noCommentsText = "<br />no comments exist<br /><br />";
                  
      $(noCommentsContainer).html(noCommentsText);
           
      $(commentHeadingContainer).append(commentButton);       
      $(commentHeadingContainer).append(commentHeading);
      $(commentContainer).append(commentHeadingContainer);
      
      $(commentContainer).append(noCommentsContainer);
                      
      $('#' + postId).append(commentContainer);
   }
   
   /**************************************************************
   *  Function displays all comments for the given post id.
   **************************************************************/
   function displayCommentsByPostId(postId) {
                 
      $.ajax({
         "url": "services/allCommentsByPostId.php",
         "data": {"postId": postId},
         "success": function(jsonResponse) {
               
            if (jsonResponse.length > 0) {
               
               if ($('#' + postId).find('.noteNoComments').length > 0) {
                     $('#' + postId).find('.noteNoComments').remove();
               }
                    
               addCommentTable(postId);
                                                                                             
               $(jsonResponse).each(function(index, element) {
                     
                  var commentTable = $('#' + postId).find('.commentTable');
                  var commentId = element.id;
                  var commentUserId = element.user_id;
                  var commentPostId = element.post_id;
                  var commentDescription = element.description;
                  var commentCreated = element.created;
                                  
                  var aComment = formatComment(commentId,
                                               commentUserId,
                                               commentDescription,
                                               commentCreated);
                  
                  $(commentTable).append(aComment);
               })
               
            }
         },
         "error":function() {

            $("#actionUnsuccessful").dialog({
                  "modal": true,
                  "buttons": {
                     "Ok": function() {
                        $( this ).dialog( "close" );
                     }
                  }
            });
         },
         "dataType":"json"
      }) 
   }


   /**************************************************************
   *  Function displays a post based on the given post id
   **************************************************************/
   function displayPostById(postId) {
    
      $.ajax({
         "url": "services/postById.php",
         "data": {"postId": postId},
         "success": function(jsonResponse) {
                       
            $(jsonResponse).each(function(index, element) {
            
               var postTitle = element.title;
               var postDescription = element.description;
               var postCreated = element.created;
               var postUserId = element.user_id;
                                
               var aPost = formatPost(postTitle, postDescription, postCreated,
                                       postUserId, postId);
                                
               $("#allPostsContainer").prepend(aPost);
                
               //Add comment section to post
               addCommentSection(postId);
                
               //Display all post comments
               displayCommentsByPostId(postId);
                            
            })
         },
         "error":function() {

            $("#actionUnsuccessful").dialog({
                  "modal": true,
                  "buttons": {
                     "Ok": function() {
			$( this ).dialog( "close" );
                     }
                  }
            });
         },
         "dataType":"json"
      }) 
   }
 
        
   /**************************************************************
   *  Function adds comments table to comment container
   **************************************************************/
   function addCommentTable(postId) {
      
         var commentTable = $("<table class ='commentTable' "
                           + "id = 'commentsForPost_" + postId + "'"
                           + "cellspacing ='0px' "
                           + "cellpadding ='4px' width = '100%'>");
                            
         var headingRow = $("<tr>"
                           + "<th align='left' valign='top'>time</th>"
                           + "<th align='left' valign='top'>created by</th>"
                           + "<th align='left' valign='top'>description</th>"
                           + "</tr>");
                           
         $(commentTable).append(headingRow);
         
         $('#' + postId).find('.commentContainer').append(commentTable);
         
   }
   
   /**************************************************************
   *  Function displays added comment and removes no comments
   *  section.
   **************************************************************/
   function displayComment(commentId, postId) {
      
      //Check if no comments note appears instead of table
      if ($('#' + postId).find('.noteNoComments').length > 0) {
         $('#' + postId).find('.noteNoComments').remove();
         addCommentTable(postId);
      }
         
      //Check if no table exists for comments
      if (!($('#' + postId).find('table').length > 0)) {
         addCommentTable(postId);
      }
               
      //Add comment to table                 
      $.ajax({
         "url": "services/commentById.php",
         "data": {"commentId": commentId},
         "success": function(jsonResponse) {
               
            if (jsonResponse.length > 0) { 
                                                              
                 $(jsonResponse).each(function(index, element) {
                  
                     var commentsTableId = $('#' + postId).find('.commentTable').attr("id");
                     var commentId = element.id;
                     var commentUserId = element.user_id;
                     var commentPostId = element.post_id;
                     var commentDescription = element.description;
                     var commentCreated = element.created;
                                      
                     var aComment = formatComment(commentId,
                                                   commentUserId,
                                                   commentDescription,
                                                   commentCreated);
                      
                     $('#' + commentsTableId + " tr:first").after(aComment);
                 })
            }
         },
         "error":function() {

            $("#actionUnsuccessful").dialog({
                  "modal": true,
                  "buttons": {
                     "Ok": function() {
			$( this ).dialog( "close" );
                     }
                  }
            });
         },
         "dataType":"json"
      }) 
   }
 
   /**************************************************************
   *  Function formats the display of a post
   **************************************************************/
   function formatPost(postTitle, postDescription, postCreated, postUserId,
                     postId) {
       
      var deleteButtonId = $("btnDeletePost[" + postId + "]");
      
      var aPost = $("<div id='" + postId + "' class='postContainer'>");
      
      var deleteButton = $("<input type='button' id='" + deleteButtonId + "'"
                        + "value='X' "
                        + "class='formDeleteButtons' />");
      
      var postTextContainer = $("<div class='postTextContainer'>");
      
      var postHeading = $("<h3>" + postTitle + "</h3>");
      
      var postDescriptionElement = $("<span class='postDescription'>"
                                  + postDescription + "<br /></span>");
            
      var postCreationElement = $("<span class='postCreationInformation'>"
                              +"(created by <strong>"
                              + postUserId
                              + "</strong> on "
                              + postCreated
                              + ")</span><br />");
      
      $(postTextContainer).append(postHeading);
      $(postTextContainer).append(postDescriptionElement);
      //$(postTextContainer).append(postCreationElement);
      
      $(aPost).append(deleteButton);
      
      $(aPost).append(postTextContainer);
     
      return aPost;
   }
 
   /**************************************************************
   *  Function confirms delete of a post and deletes a post.
   *  Note: Only users who created a post can delete it.  This
   *  function checks this requirement.
   **************************************************************/
   function deletePost(deletePostButton) {
   
      var postId = deletePostButton.parent().attr("id");
            
      if (userIdInSession != getUserIdOfPost(postId)) {
         
         $("#deletePostUnsuccessful").dialog({
            "modal": true,
            "buttons": {
               "Ok": function() {
                  $( this ).dialog( "close" );
               }
            }   
         });   
      } else {
         
         $( "#deletePost" ).dialog({
            "resizable": false,
            "height": 150,
            "modal": true,
            "buttons": {
               "delete post": function() {
                  
                  $.get("services/deletePostById.php", {                            
                        "postId":postId
                        
                  }, function(response) {
                     
                     if (response > 0) {
                        $("#" + postId).remove();
                     } else {
                        $("#actionUnsuccessful").dialog({
                           "modal": true,
                           "buttons": {
                              "Ok": function() {
                                 $( this ).dialog( "close" );
                              }
                           }
                        });
                     }
                  })
                     $( this ).dialog( "close" );
               },    
               "Cancel": function() {
                     $( this ).dialog( "close" );
               }
            }
         });
            
      } 
   }
 
   /**************************************************************
   *  Function formats the display of a comment
   **************************************************************/
   function formatComment(commentId, commentUserId,
                        commentDescription, commentCreated) {
    
      var commentTypeClass;
    
      if (userIdInSession == commentUserId) {
         commentTypeClass = "currentUserComment";
      } else {
         commentTypeClass = "otherUserComment";
      }
    
      var aComment = $("<tr class = '" + commentTypeClass + "'>");
      
      var column1 = $("<td valign='top'>" + commentCreated + "</td>");
      var column2 = $("<td valign='top'>" + commentUserId + "</td>");
      var column3 = $("<td valign='top'>" + commentDescription + "</td>");
      
      $(aComment).append(column1);
      $(aComment).append(column2);
      $(aComment).append(column3);
                                                       
      return aComment;
   }

   /**************************************************************
   *  Function adds a comment
   **************************************************************/
   function addComment(addCommentButton) {
   
      var postId = addCommentButton.parent().parent().parent().attr("id");
    
      $("#tipAddComment").text("");
        
      $("#addCommentForm" ).dialog({ 
            "height":257,
            "width":413,
            "modal":true,
            "buttons": {
               "add comment":function() {  
                  var userEnteredDescription = $.trim($("#txtDescriptionComment").val());
                    
                  //capture user input and make ajax call to update server              
                  if (userEnteredDescription.length > 0) {
                     $.get("services/addCommentByPostId.php", {
                            
                        //Run php code with these 2 paramenters
                        "description":userEnteredDescription,
                        "postId":postId

                        //callback
                     }, function(response) {
                            
                        //update user-interface on callback if
                        //response (userId) > 0
                        if(response > 0) {
                                                        
                            //Adds comment
                            displayComment(response, postId);
                            
                        } else {
                           $("#actionUnsuccessful").dialog({
                              "modal": true,
                              "buttons": {
                                 "Ok": function() {
                                    $( this ).dialog( "close" );
                                 }
                              }
                           });
                        }
                    })
                        
                    //clear values in dialog and close dialog
                    $("#txtDescriptionComment").val("");
                    $(this).dialog("close");
                    
               } else {
                    $("#tipAddComment").text("Description is required.");
               }
            },
            "cancel":function() {
                $("#txtDescriptionComment").val("");
                $(this).dialog("close");
            }           
         }
      })
   
   }

   /**************************************************************
   *  Function adds a post
   **************************************************************/
   function addPost() {
    
      $("#tipAddPost").text("");
        
      $("#addPostForm" ).dialog({ 
         "height":310,
         "width":413,
         "modal":true,
         "buttons": {
            "add post":function() {  
               var userEnteredTitle = $.trim($("#txtTitle").val());
               var userEnteredDescription = $.trim($("#txtDescription").val());
                    
               //capture user input and make ajax call to update server              
               if (userEnteredDescription.length > 0
                     && userEnteredTitle.length > 0) {
                  $.get("services/addPost.php", {
                            
                        //Run php code with these 2 paramenters
                        "title":userEnteredTitle,
                        "description":userEnteredDescription
                            
                  //callback
                  }, function(response) {
                            
                     //update user-interface on callback if
                     //response (userId) > 0
                     if(response > 0) {
                            
                        //Function retrieves from db in order to obtain
                        //created timestamp
                        displayPostById(response);                            
                     } else {
                        $("#actionUnsuccessful").dialog({
                           "modal": true,
                           "buttons": {
                              "Ok": function() {
                                 $( this ).dialog( "close" );
                              }
                           }
                        });
                     }
                  })
                        
                  //clear values in dialog and close dialog
                  $("#txtTitle, #txtDescription").val("");
                  $(this).dialog("close");
                    
               } else {
                  $("#tipAddPost").text("Title and description are both required.");
               }
            },
            "cancel":function() {
               $("#txtTitle, #txtDescription").val("");
               $(this).dialog("close");
            }
                
         }
      })
   }