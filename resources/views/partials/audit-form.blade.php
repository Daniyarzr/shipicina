@if (session('success'))
    <div class="alert alert--success" data-reveal>{{ session('success') }}</div>
@endif

@if (session('mail_warning'))
    <div class="alert alert--warn" data-reveal>{{ session('mail_warning') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert--error" data-reveal>
        <p>Проверьте форму:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" action="{{ route('audit.store') }}" method="post" id="audit-form" data-reveal>
    @csrf
    <label class="field">
        <span>Имя</span>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Как к вам обращаться" required>
    </label>

    <label class="field">
        <span>Телефон</span>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+7 (___) ___-__-__" required>
    </label>

    <label class="field">
        <span>Ваша ситуация или пожелания</span>
        <textarea name="situation" rows="4" placeholder="Кратко опишите задачу">{{ old('situation') }}</textarea>
    </label>

    <button class="btn btn--full" type="submit">Отправить заявку</button>
</form>
