@if($show)
    <div id="messageFlash" class="grid grid-cols-5 gap-2">
        <div class="col-start-2 col-span-4 bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 w-3/4" role="alert">
                            <p class="font-bold">{{$title}}</p>
                            <p class="text-sm">{{$msg}}</p>
                       </div>
    </div>

@endif
    <script>
        $(document).ready(function(){
            Livewire.on('showEvent', postId => {
                $('#messageFlash').slideDown(300).delay( 3000 ).slideUp(300);
            })
        })
    </script>

