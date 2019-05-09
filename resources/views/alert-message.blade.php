@if (\Session::has('flash_message'))    
    <div class="alert alert-success">
        <p>{{ \Session::get('flash_message') }}</p>
    </div>  
@endif  

@if (\Session::has('error_flash_message'))    
    <div class="alert alert-danger">
        <p>{{ \Session::get('error_flash_message') }}</p>
    </div>  
@endif  