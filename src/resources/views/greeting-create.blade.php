<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挨拶の追加 - Add Greeting</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        header {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
            text-align: center;
        }
        h1 {
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            color: #666;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
        }
        .required {
            color: #e74c3c;
        }
        .optional {
            color: #999;
            font-size: 0.9rem;
            font-weight: normal;
        }
        .btn {
            width: 100%;
            padding: 1rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #5568d3;
        }
        .nav-links {
            margin-top: 2rem;
            text-align: center;
        }
        .nav-links a {
            display: inline-block;
            margin: 0 1rem;
            color: white;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: background 0.3s ease;
        }
        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
        .help-text {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>挨拶の追加</h1>
            <p class="subtitle">Add Greeting</p>
        </header>

        <div class="form-container">
            <form action="/greeting" method="POST">
                @csrf

                <div class="form-group">
                    <label for="text">挨拶テキスト <span class="required">*</span></label>
                    <input type="text" id="text" name="text" value="{{ old('text') }}" placeholder="例: おはようございます" required>
                    @error('text')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="meaning">意味 <span class="required">*</span></label>
                    <input type="text" id="meaning" name="meaning" value="{{ old('meaning') }}" placeholder="例: 朝の挨拶" required>
                    @error('meaning')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="time_of_day">時間帯 <span class="optional">(オプション)</span></label>
                    <input type="text" id="time_of_day" name="time_of_day" value="{{ old('time_of_day') }}" placeholder="例: 朝、昼、夜">
                    <p class="help-text">朝、昼、夜などの時間帯を入力してください</p>
                    @error('time_of_day')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="person_id">誰が挨拶する？ <span class="optional">(オプション)</span></label>
                    <select id="person_id" name="person_id">
                        <option value="">選択してください</option>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                                {{ $person->name }} ({{ $person->role }})
                            </option>
                        @endforeach
                    </select>
                    @error('person_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn">追加する</button>
            </form>
        </div>

        <div class="nav-links">
            <a href="/greeting">挨拶のページ</a>
            <a href="/">トップページ</a>
        </div>
    </div>
</body>
</html>
