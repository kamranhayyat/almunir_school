<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('store-event') }}" method="POST">
        @csrf
        Event name:
        <br />
        <input type="text" name="title" />
        <br /><br />
        Task description:
        <br />
        <textarea name="description"></textarea>
        <br /><br />
        Start time:
        <br />
        <input type="date" name="event_date" />
        <br /><br />
        <input type="submit" value="Save" />
      </form>
</body>
</html>