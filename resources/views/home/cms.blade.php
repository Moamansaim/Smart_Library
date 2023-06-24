@extends('layout.cms')
@section('content')
    @if (Auth::guard('admin')->check())
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"> {{ __('Welcome') }} {{ Auth::user()->name }}🎉</h5>
                                    <p class="mb-4">
                                        {{ __('Through this control panel, you can manage your website,, an enjoyable experience') }}
                                    </p>

                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">{{ __('View Websit') }}</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bx-book-bookmark text-info' style="font-size:30px"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.book') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">{{ __('Book') }}</span>
                                    <h3 class="card-title mb-2">{{ $book->count() }}</h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-category text-success" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.category') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span>{{ __('Category') }}</span>
                                    <h3 class="card-title text-nowrap mb-1">{{ $category->count() }}</h3>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->

                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-home-alt text-warning" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.homePublish') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">{{ __('Home Publish') }}</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $homePublish->count() }}</h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-edit-alt text-primary" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.writer') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">{{ __('Writer') }}</span>
                                    <h3 class="card-title mb-2">{{ $writer->count() }}</h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-user text-primary" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.user') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">{{ __('User') }}</span>
                                    <h3 class="card-title mb-2">{{ $user->count() }}</h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-edit-alt text-primary" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.writer') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">{{ __('Writer') }}</span>
                                    <h3 class="card-title mb-2">{{ $writer->count() }}</h3>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bxs-user-rectangle text-warning" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.admin') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">{{ __('Admin') }}</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $admin->count() }}</h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-shield-alt-2 text-primary" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.role') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">{{ __('Role') }}</span>
                                    <h3 class="card-title mb-2">{{ $role->count() }}</h3>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx bx-purchase-tag-alt text-primary" style="font-size:30px "></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item"
                                                    href="{{ route('index.permissions') }}">{{ __('View More') }}</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">{{ __('Permissions') }}</span>
                                    <h3 class="card-title mb-2">{{ $permissions->count() }}</h3>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- / Content -->
        @else
            <div class="container mt-5 m-auto">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"> {{ __('Welcome') }} {{ Auth::user()->name }}🎉</h5>
                                    <p class="mb-4">
                                        {{ Auth::user()->name }} {{ __('you can download and browse all kinds of books that you want') }}
                                    </p>

                                   
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@endsection
