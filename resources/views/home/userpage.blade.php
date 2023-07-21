
<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
     <!-- Basic -->
     <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="">
      <title>User Page</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
        @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
     @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product')
     
      <!-- end product section -->

      <!-- subscribe section -->
      <div class="container">
        
         <form action="/addcomment" method="post">
            @csrf
            <div class="text-center">
            <textarea name="comment" style="height:150px;width:600px" placeholder="Comment Something here"></textarea>
            <input type="submit" value="Add">
            </div>
         </form>
         <h1>All Comments</h1><br><br>
         @foreach($comments as $comment)
         <div style="margin-bottom:20px">
          <b>{{$comment->name}}</b>
          <p>{{$comment->comment}}</p>
          <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">reply</a>
          
         
          @foreach($replys as $reply)
          @if($comment->id==$reply->commentid)
          <div style="padding-left:3%;padding-bottom:10px;padding-top:10px">
            <b>{{$reply->name}}</b>
            <p>{{$reply->reply}}</p>
            <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">reply</a>
          </div>
          @endif
          @endforeach
         </div>
       
       
         
         @endforeach
         <div style="display:none" class="replyDiv">
            <form action="/addreply" method="post">
               @csrf
               <textarea style="height:100px;width:500px" placeholder="Add your reply" name="reply"></textarea>
               <input type="submit" style="margin-left:0px" value="reply">
               <input type="hidden" id="commentid" name="commentid">
               <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">close</a>
            </form>
         </div>
         
        
         
      </div>
      @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
     @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <script type="text/javascript">
         function reply(caller)
         {
            document.getElementById('commentid').value=$(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();

         }
         function reply_close(caller)
         {
           
            $('.replyDiv').hide();

         }

      </script>
        <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>