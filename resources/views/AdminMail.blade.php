<x-mail::message>
    # Introduction

    The body of your message.

    <a id="btn" href="{{ route('cms') }}">GO TO CMS</a>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>

<style>
    #id {

        margin: auto;
        width: 300px;
        padding: 5px;
        background-color: rgb(0, 0, 0);
        color: #eee;
        border-radius: 5px;
        text-decoration: none;



    }
</style>
