<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        form {
            margin-bottom: 30px;
        }

        input,
        textarea,
        button {
            display: block;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            cursor: pointer;
        }

        .todo {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Todo List</h1>

    @if (session('success'))
        <p class="success">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf

        <label for="title">Title</label>
        <input
            id="title"
            type="text"
            name="title"
            value="{{ old('title') }}"
            placeholder="Enter todo title"
        >

        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
            placeholder="Enter todo description"
        >{{ old('description') }}</textarea>

        <button type="submit">
            Add Todo
        </button>
    </form>

    <section>
        <h2>My Todos</h2>

        @forelse ($todos as $todo)
            <article class="todo">
                <h3>{{ $todo->title }}</h3>

                @if ($todo->description)
                    <p>{{ $todo->description }}</p>
                @endif

                <small>
                    Status:
                    {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                </small>
            </article>
        @empty
            <p>No todos found.</p>
        @endforelse
    </section>
</body>
</html>
