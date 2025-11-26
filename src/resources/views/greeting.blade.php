<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挨拶 - Greeting</title>
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
            max-width: 1200px;
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
        .greeting-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .greeting-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .greeting-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .greeting-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .greeting-text {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .greeting-meaning {
            color: #667eea;
            font-size: 0.9rem;
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
        .add-btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .add-btn:hover {
            background: #5568d3;
        }
        .delete-btn {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }
        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>挨拶のページ</h1>
            <p class="subtitle">Greeting Page</p>
            <a href="/greeting/create" class="add-btn">+ 挨拶を追加</a>
        </header>

        @if($greetings->isEmpty())
            <div style="background: white; padding: 2rem; border-radius: 1rem; text-align: center;">
                <p style="color: #666;">挨拶データがありません。Tinkerでデータを追加してください。</p>
            </div>
        @else
            <div class="greeting-grid">
                @foreach($greetings as $greeting)
                    <div class="greeting-card">
                        <div class="greeting-icon">👋</div>
                        <h2 class="greeting-text">{{ $greeting->text }}</h2>
                        <p class="greeting-meaning">{{ $greeting->meaning }}</p>
                        @if($greeting->time_of_day)
                            <p style="color: #999; font-size: 0.8rem; margin-top: 0.5rem;">{{ $greeting->time_of_day }}</p>
                        @endif
                        @if($greeting->person)
                            <p style="color: #667eea; font-size: 0.9rem; margin-top: 0.75rem; font-weight: bold;">
                                👤 {{ $greeting->person->name }}
                            </p>
                            <p style="color: #999; font-size: 0.8rem;">{{ $greeting->person->role }}</p>
                        @endif
                        <form action="/greeting/{{ $greeting->id }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">削除</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="nav-links">
            <a href="/">トップページ</a>
            <a href="/people">人のページ</a>
            <a href="/api-test">API テスト</a>
        </div>
    </div>
</body>
</html>
