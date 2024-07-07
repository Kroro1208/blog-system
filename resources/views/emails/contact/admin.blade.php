<!DOCTYPE html>
<html>
<head>
    <title>Contact Admin Mail</title>
</head>
<body>
    <h1>お問い合わせ内容</h1>
    <p>名前: {{ $validated['name'] }}</p>
    <p>メール: {{ $validated['email'] }}</p>
    <p>メッセージ: {{ $validated['content'] }}</p>
</body>
</html>
