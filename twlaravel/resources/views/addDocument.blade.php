<!DOCTYPE html>
<html>
  <head>
    <title>How to Upload a File in Laravel</title>
  </head>
  <body>
    <!-- Message -->
    @if(Session::has('message'))
      <p >{{ Session::get('message') }}</p>
    @endif

    <!-- Form -->
    <form method='post' action='/api/uploadDocument' enctype='multipart/form-data' >
      {{ csrf_field() }}
      Json document:
            <br />
      <input type="file" name="file" accept=".json" />
      <input type="hidden" name="type" value="addDocument">
      <input type='submit' name='submit' value='Upload'>
    </form>
  </body>
</html>