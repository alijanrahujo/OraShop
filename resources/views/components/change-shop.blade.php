<li class="hidden-sm">
    <form action="{{Route('shop.change')}}" method="POST" class="form-inline mt-3">
            @csrf
            <select name="shop_id" id="shop_id" class="form-control" onchange="this.form.submit()">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}" {{ $currentShop == $shop->id ? 'selected' : '' }}>
                        {{ $shop->title }}
                    </option>
                @endforeach
            </select>
        </form>
    {{-- <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript: void(0);" role="button"
        aria-haspopup="false" aria-expanded="false">
        Shop <i class="mdi mdi-chevron-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <form action="" method="POST" class="form-inline">
            @csrf
            <select name="shop_id" id="shop_id" class="form-control" onchange="this.form.submit()">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}" {{ $currentShop == $shop->id ? 'selected' : '' }}>
                        {{ $shop->title }}
                    </option>
                @endforeach
            </select>
        </form>
        <a class="dropdown-item" href="javascript: void(0);"><span> German </span><img src="{{ asset('admin/assets/images/flags/germany_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
        <a class="dropdown-item" href="javascript: void(0);"><span> Italian </span><img src="{{ asset('admin/assets/images/flags/italy_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
        <a class="dropdown-item" href="javascript: void(0);"><span> French </span><img src="{{ asset('admin/assets/images/flags/french_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
        <a class="dropdown-item" href="javascript: void(0);"><span> Spanish </span><img src="{{ asset('admin/assets/images/flags/spain_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
        <a class="dropdown-item" href="javascript: void(0);"><span> Russian </span><img src="{{ asset('admin/assets/images/flags/russia_flag.jpg') }}" alt="" class="ml-2 float-right" height="14"/></a>
    </div> --}}
</li>
