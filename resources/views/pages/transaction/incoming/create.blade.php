@extends('layouts.main')

@section('content')
    <x-breadcrumb
        :values="[__('menu.transaction.menu'), __('menu.transaction.incoming_letter'), __('menu.general.create')]">
    </x-breadcrumb>

    <div class="card mb-4">
        <form action="{{ route('transaction.incoming.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <div class="card-body row">
                <input type="hidden" name="type" value="incoming">
                <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                    <x-input-form name="reference_number" :label="__('model.letter.reference_number')"/>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                    <x-input-form name="from" :label="__('model.letter.from')"/>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                    <x-input-form name="agenda_number" :label="__('model.letter.agenda_number')"/>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                    <x-input-form name="letter_date" :label="__('model.letter.letter_date')" type="date" id="letter_date"/>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                    <x-input-form name="received_date" :label="__('model.letter.received_date')" type="date" id="received_date"/>
                </div>
                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                    <x-input-textarea-form name="description" :label="__('model.letter.description')"/>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <label for="classification_code"
                               class="form-label">{{ __('model.letter.classification_code') }}</label>
                        <select class="form-select" id="classification_code" name="classification_code">
                            @foreach($classifications as $classification)
                                <option
                                    value="{{ $classification->code }}"
                                    @selected(old('classification_code') == $classification->code)>
                                    {{ $classification->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <label for="note" class="form-label">{{ __('model.letter.note') }}</label>
                        <select class="form-select @error('note') is-invalid @enderror" id="note" name="note">
                            @foreach ($status as $item)
                                <option value="{{ $item->status }}" @selected(old('note', $data->note ?? '') == $item->status)>
                                    {{ $item->status }}
                                </option>
                            @endforeach
                        </select>
                        @error('note')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <label for="attachments" class="form-label">{{ __('model.letter.attachment') }}</label>
                        <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments"
                               name="attachments[]" multiple/>
                        <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer pt-0">
                <button class="btn btn-primary" type="submit">{{ __('menu.general.save') }}</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function validateForm() {
        const tanggalSurat = document.getElementById('letter_date').value;
        const tanggalTerima = document.getElementById('received_date').value;

        if (tanggalSurat && tanggalTerima) {
            const tSurat = new Date(tanggalSurat);
            const tTerima = new Date(tanggalTerima);

            if (tTerima < tSurat) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tanggal Tidak Valid',
                    text: 'Tanggal Terima Surat tidak boleh lebih dulu dari Tanggal Surat.',
                });
                return false;
            }
        }
        return true;
    }
</script>

@endsection
