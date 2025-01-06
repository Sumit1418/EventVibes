@extends('layouts.companylayout')
@section('title', 'Help')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/help.css') }}">
@endsection
@section('content')
    <div class="help-container">
        <div class="help-head">
            <h1>Frequently Asked Questions</h1>
            <h1 id="small">F & Q</h1>
            <input type="text" placeholder="Search for a question...">
        </div>
        <div class="help-body">
            <div class="faq-item">
                <div class="faq-question">How do I register for an event?</div>
                <div class="faq-answer">
                    <p>To register for an event, you need to log in to your account and navigate to the event's page. There, you'll find a registration button. Click on it and follow the instructions to complete your registration.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Can I cancel my registration for an event?</div>
                <div class="faq-answer">
                    <p>Yes, you can cancel your registration for an event. Simply log in to your account, go to the event's page, and you'll find an option to cancel your registration.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">How can I contact the event organizer?</div>
                <div class="faq-answer">
                    <p>You can contact the event organizer by sending an email to <a href="mailto:bhawna8798sharma@gmail.com">bhawna8798sharma@gmail.com</a>. Alternatively, you can use the contact form available on the event's page.</p>
                </div>
            </div>
        </div>  
    </div>
@endsection
<script>
    // filter questions when input change
    document.addEventListener('DOMContentLoaded', function() {
            // filter questions when input change
            document.querySelector('input').addEventListener('input', function() {
                let search = this.value.toLowerCase();
                console.log(search);
                let faqItems = document.querySelectorAll('.faq-item');
                faqItems.forEach(function(item) {
                    let question = item.querySelector('.faq-question').textContent.toLowerCase();
                    let answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                    if (question.includes(search) || answer.includes(search)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
</script>