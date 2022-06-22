
<!-- Page Heading -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
                <h1>{{ $header }}</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Page Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
@stack('modals')

@livewireScripts

@stack('scripts')
