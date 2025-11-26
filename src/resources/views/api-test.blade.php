<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>API テスト</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">API テストページ</h1>

        <!-- ナビゲーション -->
        <div class="mb-6">
            <a href="/" class="text-blue-600 hover:text-blue-800 mr-4">ホーム</a>
            <a href="/people" class="text-blue-600 hover:text-blue-800 mr-4">人一覧</a>
            <a href="/greeting" class="text-blue-600 hover:text-blue-800 mr-4">挨拶一覧</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- People API Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">People API</h2>

                <!-- GET All People -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">GET /api/people</h3>
                    <button onclick="getAllPeople()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        全ての人を取得
                    </button>
                </div>

                <!-- GET Person by ID -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">GET /api/people/{id}</h3>
                    <div class="flex gap-2">
                        <input type="number" id="getPersonId" placeholder="ID" class="border rounded px-3 py-2 w-24">
                        <button onclick="getPersonById()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            取得
                        </button>
                    </div>
                </div>

                <!-- POST Create Person -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">POST /api/people</h3>
                    <div class="space-y-2">
                        <input type="text" id="personName" placeholder="名前" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="personRole" placeholder="役割" class="border rounded px-3 py-2 w-full">
                        <input type="email" id="personEmail" placeholder="メール" class="border rounded px-3 py-2 w-full">
                        <button onclick="createPerson()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            作成
                        </button>
                    </div>
                </div>

                <!-- PUT Update Person -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">PUT /api/people/{id}</h3>
                    <div class="space-y-2">
                        <input type="number" id="updatePersonId" placeholder="ID" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="updatePersonName" placeholder="名前" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="updatePersonRole" placeholder="役割" class="border rounded px-3 py-2 w-full">
                        <input type="email" id="updatePersonEmail" placeholder="メール" class="border rounded px-3 py-2 w-full">
                        <button onclick="updatePerson()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            更新
                        </button>
                    </div>
                </div>

                <!-- DELETE Person -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">DELETE /api/people/{id}</h3>
                    <div class="flex gap-2">
                        <input type="number" id="deletePersonId" placeholder="ID" class="border rounded px-3 py-2 w-24">
                        <button onclick="deletePerson()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            削除
                        </button>
                    </div>
                </div>
            </div>

            <!-- Greetings API Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Greetings API</h2>

                <!-- GET All Greetings -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">GET /api/greetings</h3>
                    <button onclick="getAllGreetings()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        全ての挨拶を取得
                    </button>
                </div>

                <!-- GET Greeting by ID -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">GET /api/greetings/{id}</h3>
                    <div class="flex gap-2">
                        <input type="number" id="getGreetingId" placeholder="ID" class="border rounded px-3 py-2 w-24">
                        <button onclick="getGreetingById()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            取得
                        </button>
                    </div>
                </div>

                <!-- POST Create Greeting -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">POST /api/greetings</h3>
                    <div class="space-y-2">
                        <input type="text" id="greetingText" placeholder="テキスト" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="greetingMeaning" placeholder="意味" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="greetingTimeOfDay" placeholder="時間帯" class="border rounded px-3 py-2 w-full">
                        <input type="number" id="greetingPersonId" placeholder="Person ID" class="border rounded px-3 py-2 w-full">
                        <button onclick="createGreeting()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            作成
                        </button>
                    </div>
                </div>

                <!-- PUT Update Greeting -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">PUT /api/greetings/{id}</h3>
                    <div class="space-y-2">
                        <input type="number" id="updateGreetingId" placeholder="ID" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="updateGreetingText" placeholder="テキスト" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="updateGreetingMeaning" placeholder="意味" class="border rounded px-3 py-2 w-full">
                        <input type="text" id="updateGreetingTimeOfDay" placeholder="時間帯" class="border rounded px-3 py-2 w-full">
                        <button onclick="updateGreeting()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            更新
                        </button>
                    </div>
                </div>

                <!-- DELETE Greeting -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-2 text-gray-600">DELETE /api/greetings/{id}</h3>
                    <div class="flex gap-2">
                        <input type="number" id="deleteGreetingId" placeholder="ID" class="border rounded px-3 py-2 w-24">
                        <button onclick="deleteGreeting()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            削除
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Response Section -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">レスポンス</h2>
            <div class="mb-4">
                <div class="flex items-center gap-4 mb-2">
                    <span class="font-medium">ステータス:</span>
                    <span id="responseStatus" class="font-mono"></span>
                </div>
                <div class="flex items-center gap-4 mb-2">
                    <span class="font-medium">メソッド:</span>
                    <span id="responseMethod" class="font-mono"></span>
                </div>
                <div class="flex items-center gap-4 mb-2">
                    <span class="font-medium">URL:</span>
                    <span id="responseUrl" class="font-mono text-sm"></span>
                </div>
            </div>
            <pre id="response" class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>レスポンスがここに表示されます</code></pre>
        </div>
    </div>

    <script>
        // CSRF Token Setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Display Response Helper
        function displayResponse(method, url, status, data) {
            document.getElementById('responseMethod').textContent = method;
            document.getElementById('responseUrl').textContent = url;
            document.getElementById('responseStatus').textContent = status;
            document.getElementById('responseStatus').className =
                status >= 200 && status < 300
                    ? 'font-mono text-green-600'
                    : 'font-mono text-red-600';
            document.getElementById('response').innerHTML =
                '<code>' + JSON.stringify(data, null, 2) + '</code>';
        }

        // People API Functions
        async function getAllPeople() {
            try {
                const response = await fetch('/api/people');
                const data = await response.json();
                displayResponse('GET', '/api/people', response.status, data);
            } catch (error) {
                displayResponse('GET', '/api/people', 'ERROR', { error: error.message });
            }
        }

        async function getPersonById() {
            const id = document.getElementById('getPersonId').value;
            if (!id) return alert('IDを入力してください');

            try {
                const response = await fetch(`/api/people/${id}`);
                const data = await response.json();
                displayResponse('GET', `/api/people/${id}`, response.status, data);
            } catch (error) {
                displayResponse('GET', `/api/people/${id}`, 'ERROR', { error: error.message });
            }
        }

        async function createPerson() {
            const name = document.getElementById('personName').value;
            const role = document.getElementById('personRole').value;
            const email = document.getElementById('personEmail').value;

            if (!name || !role) return alert('名前と役割は必須です');

            try {
                const response = await fetch('/api/people', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ name, role, email })
                });
                const data = await response.json();
                displayResponse('POST', '/api/people', response.status, data);

                if (response.ok) {
                    document.getElementById('personName').value = '';
                    document.getElementById('personRole').value = '';
                    document.getElementById('personEmail').value = '';
                }
            } catch (error) {
                displayResponse('POST', '/api/people', 'ERROR', { error: error.message });
            }
        }

        async function updatePerson() {
            const id = document.getElementById('updatePersonId').value;
            const name = document.getElementById('updatePersonName').value;
            const role = document.getElementById('updatePersonRole').value;
            const email = document.getElementById('updatePersonEmail').value;

            if (!id) return alert('IDを入力してください');

            const body = {};
            if (name) body.name = name;
            if (role) body.role = role;
            if (email) body.email = email;

            try {
                const response = await fetch(`/api/people/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(body)
                });
                const data = await response.json();
                displayResponse('PUT', `/api/people/${id}`, response.status, data);
            } catch (error) {
                displayResponse('PUT', `/api/people/${id}`, 'ERROR', { error: error.message });
            }
        }

        async function deletePerson() {
            const id = document.getElementById('deletePersonId').value;
            if (!id) return alert('IDを入力してください');

            if (!confirm('本当に削除しますか?')) return;

            try {
                const response = await fetch(`/api/people/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await response.json();
                displayResponse('DELETE', `/api/people/${id}`, response.status, data);
            } catch (error) {
                displayResponse('DELETE', `/api/people/${id}`, 'ERROR', { error: error.message });
            }
        }

        // Greetings API Functions
        async function getAllGreetings() {
            try {
                const response = await fetch('/api/greetings');
                const data = await response.json();
                displayResponse('GET', '/api/greetings', response.status, data);
            } catch (error) {
                displayResponse('GET', '/api/greetings', 'ERROR', { error: error.message });
            }
        }

        async function getGreetingById() {
            const id = document.getElementById('getGreetingId').value;
            if (!id) return alert('IDを入力してください');

            try {
                const response = await fetch(`/api/greetings/${id}`);
                const data = await response.json();
                displayResponse('GET', `/api/greetings/${id}`, response.status, data);
            } catch (error) {
                displayResponse('GET', `/api/greetings/${id}`, 'ERROR', { error: error.message });
            }
        }

        async function createGreeting() {
            const text = document.getElementById('greetingText').value;
            const meaning = document.getElementById('greetingMeaning').value;
            const time_of_day = document.getElementById('greetingTimeOfDay').value;
            const person_id = document.getElementById('greetingPersonId').value;

            if (!text || !meaning) return alert('テキストと意味は必須です');

            const body = { text, meaning };
            if (time_of_day) body.time_of_day = time_of_day;
            if (person_id) body.person_id = parseInt(person_id);

            try {
                const response = await fetch('/api/greetings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(body)
                });
                const data = await response.json();
                displayResponse('POST', '/api/greetings', response.status, data);

                if (response.ok) {
                    document.getElementById('greetingText').value = '';
                    document.getElementById('greetingMeaning').value = '';
                    document.getElementById('greetingTimeOfDay').value = '';
                    document.getElementById('greetingPersonId').value = '';
                }
            } catch (error) {
                displayResponse('POST', '/api/greetings', 'ERROR', { error: error.message });
            }
        }

        async function updateGreeting() {
            const id = document.getElementById('updateGreetingId').value;
            const text = document.getElementById('updateGreetingText').value;
            const meaning = document.getElementById('updateGreetingMeaning').value;
            const time_of_day = document.getElementById('updateGreetingTimeOfDay').value;

            if (!id) return alert('IDを入力してください');

            const body = {};
            if (text) body.text = text;
            if (meaning) body.meaning = meaning;
            if (time_of_day) body.time_of_day = time_of_day;

            try {
                const response = await fetch(`/api/greetings/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(body)
                });
                const data = await response.json();
                displayResponse('PUT', `/api/greetings/${id}`, response.status, data);
            } catch (error) {
                displayResponse('PUT', `/api/greetings/${id}`, 'ERROR', { error: error.message });
            }
        }

        async function deleteGreeting() {
            const id = document.getElementById('deleteGreetingId').value;
            if (!id) return alert('IDを入力してください');

            if (!confirm('本当に削除しますか?')) return;

            try {
                const response = await fetch(`/api/greetings/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await response.json();
                displayResponse('DELETE', `/api/greetings/${id}`, response.status, data);
            } catch (error) {
                displayResponse('DELETE', `/api/greetings/${id}`, 'ERROR', { error: error.message });
            }
        }
    </script>
</body>
</html>
