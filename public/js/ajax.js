$(document).ready(function(){
    /*
     * When the user click on the submit button this function
     * starts.
     */

  

        $(".submit").click(function (e){
               // Stop the form from redirect to sendMessage page
                  e.preventDefault();

                  // Store form values into variables
                  var idR = $('.idR').val();
                  var message = $('.form_message').val();

                  if(message !== ''){

                      // Send the POST request
                      $.post('/chat/sendMessage', {
                         idR: idR,
                         message: message
                      });

                     // Load the messages in the chat 
                     $('.messages').load('/chat p').html();

                     //Auto-scroll down
                     var oldscroll = $('.messages').scrollTop();
                     $('.messages').animate({ scrollTop: oldscroll + $('.messages').height() },500);

                     // Clear the value of the <textarea> input
                     $('.form_message').val('');

                  } else {
                      alert('Il n\'y a rien dans votre message ...');
                  }
        });

        $('.form_message').on('keyup', function(e) {
            if (e.which == 13 && ! e.shiftKey) {
            // Stop the form from redirect to sendMessage page
            e.preventDefault();

            // Store form values into variables
            var idR = $('.idR').val();
            var message = $('.form_message').val();

            if(message !== ''){

                // Send the POST request
                $.post('/chat/sendMessage', {
                   idR: idR,
                   message: message
                });

               // Load the messages in the chat 
               $('.messages').load('/chat p').html();

               //Auto-scroll down
               var oldscroll = $('.messages').scrollTop();
               $('.messages').animate({ scrollTop: oldscroll + $('.messages').height() },500);

               // Clear the value of the <textarea> input
               $('.form_message').val('');

            } else {
                alert('Il n\'y a rien dans votre message ...');
            }
        }
    });
        $.fn.scrollBottom = function() {
            return $(document).height() - this.scrollTop() - (this.height()*10);
        };
    
    // "refresh" chat every second (1000ms)
  setInterval(function() {
        

  
        var oldmess = $('.last').html();
        // Load the messages
        $('.messages').load('/chat .conversation').html();
        $('.list-conversation').load('/chat .list-conversation').html();
        
        var newmes = $('.last').html();
        
        $('.messages').scrollBottom();
        
        if (newmes !== oldmess) {
          $('.messages').scrollBottom();
        };
    

}, 1000);

    
    $('ul').on('click', '.contact', function(e){
      
       // Stop the refresh of the page
       e.preventDefault(); 
       
       var id = $(this).attr('id');
       
        $.post('/chat/selectConvers', {
               idR: id
            });
        
        $('#' + id).addClass('select');
        $('.idR').val(id);
        $('.messages').load('/chat .conversation').html();
    });
    
    $('ul').on('click', '.userStart', function(e){
      
       e.preventDefault();
      
        var id = $(this).attr('id');
       
        $.post('/chat/selectConvers', {
               idR: id
            });
        $('.idR').val(id);
        $('.messages').load('/chat .conversation').html();
    });
    
    /*
     * Everytime an user write something on the search field
     * we search all the users with this nickname
     */
    $("#user_input").bind("change paste keyup", function() {

        if($(this).val() !== null){
            
            // We search the user
            var request = $.post('/chat/searchUser', {
               username:$(this).val()
            });
            
            // We display the result of the query
            request.done(function( data ) {
                 $(".search").empty().append($(data).find( ".result" ));
                });
        }
    });
});
