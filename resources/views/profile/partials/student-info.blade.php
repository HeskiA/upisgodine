<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informacije o studentu') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('U slučaju krivih informacija, hitno se obratite ECTS koordinatoru!') }}
        </p>
    </header>

    @php 
        $student = App\Http\Controllers\ProfileController::getUser(Auth::user()->id)
    @endphp

    <div>
        <strong>Prosjek: </strong>{{$student->prosjek}} <br>
        <strong>Broj ECTS bodova: </strong>{{$student->ects}} <br>
        <strong>Broj godina studiranja: </strong>{{$student->godstud}}
    </div>

</section>
