<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon-2.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Fobia</h4>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon> <!-- Ubah ikon home-outline menjadi grid-outline -->
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('aset.index') }}">
                <div class="parent-icon">
                    <ion-icon name="pricetag-outline"></ion-icon> <!-- Ubah ikon home-outline menjadi pricetag-outline -->
                </div>
                <div class="menu-title">Data Aset</div>
            </a>
        </li>
        <li>
            <a href="invoice.php">
                <div class="parent-icon">
                    <ion-icon name="document-text-outline"></ion-icon> <!-- Ubah ikon home-outline menjadi document-text-outline -->
                </div>
                <div class="menu-title">Invoice</div>
            </a>
        </li>        
    </ul>
    <!--end navigation-->
</aside>
