<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/store" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" class="text" name="name">
        <input type="file" class="file" name="file">
        <input type="submit" value="click me">
    </form>
  <form method="POST" action="/download" >
      {{ csrf_field() }}
      <input type="text" class="text" name="name">
      <input type="submit" value="click me">
  </form>
    <table style="width:100%">
            <tr>
              <th>Name</th>
              <th>Download</th> 
              
            </tr>
            @foreach ($files as $file )
            @if ($file->delete != true)
            <tr>
                    <td>{{$file ->name}}</td>
                  <td><a href="{{$file->file}}" download="{{$file->file}}">Download</a></td>
                    
                  </tr>
                  @endif
            @endforeach
           
           
          </table>
</body>
</html>