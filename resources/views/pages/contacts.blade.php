@extends('layouts.app')

@section('title', 'Контакты | Татьяна Щипицина')
@section('description', 'Записаться на бесплатный аудит: оставьте заявку и получите обратную связь в течение 2 часов.')

@section('content')
    <section class="section page-top">
        <div class="container cta-grid">
            <article data-reveal>
                <p class="eyebrow">Контакты</p>
                <h1>Записаться на бесплатный аудит</h1>
                <p>Оставьте заявку в форме ниже, расскажите о своих пожеланиях, и я свяжусь с вами в течение 2 часов для назначения встречи.</p>
                <p class="cta-contact">Тел.: <a href="tel:+79120166581">+7 912 016-65-81</a></p>
                <p class="cta-contact">Email: <a href="mailto:Tsm1981@bk.ru">Tsm1981@bk.ru</a></p>
            </article>
            <div>
                @include('partials.audit-form')
            </div>
        </div>
    </section>
@endsection
