<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- promo_code -->
            <div>
                <x-label for="promo_code" :value="__('Promo Code')" />
                <span>(if available)</span>

                <x-input id="promo_code" class="block mt-1 w-full" type="text" name="promo_code" :value="old('promo_code')"  autofocus />
                
                <div id="validate_promo" class="alert alert-primary" role="alert" style="color: blue" >
                   
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<script>

    $("#promo_code").keyup(function() {
        var promo_code = $(this).val();
        // alert('hello');
        

        if (promo_code) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo route('validate.promo') ?>",
                data: {
                    _token: '{{ csrf_token() }}',
                    promo_code: promo_code

                },
                beforeSend: function() {
                    
                },
                success: function(data) {

                    $("#validate_promo").empty();
                    
                    if(data>0){

                        

                        $('#validate_promo').html('<p>Valid Promo Code</p>');

                    }else{
                        
                        $('#validate_promo').html('<p>Invalid Promo Code</p>');
                    }
                    

                    
                }
            });

        }else {

            $("#validate_promo").empty();

        }
    });

</script>
