@extends('layouts.app')

@section('content')

<div class="h-100 my-3 p-3 text-bg-light border rounded-3">
    <div class="row">
        <div class="col-sm-4">
            <img src="/images/computers.svg" alt="Picture of person with computer" class="img-fluid border-none" />
        </div>

        <div class="col-sm-1"></div>

        <div class="col-sm-7 d-flex align-items-center">
            <div>
                <h2>Need a new Computer?</h2>
                <p>Well our Computers are the best in the business and have all the right specs for whatever you need to
                    do whether it is Gaming or Office Work.</p>
                <a class="btn btn-outline-dark" href="/computers"><i class="fa-solid fa-desktop"></i> Our Computers</a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-3 d-grid gap-2">
        <a class="btn btn-dark" href="/computers"><i class="fa-solid fa-desktop"></i> Computers</a>
    </div>

    <div class="col-sm-3 d-grid gap-2">
        <a class="btn btn-dark" href="/laptops"><i class="fa-solid fa-laptop"></i> Laptops</a>
    </div>

    <div class="col-sm-3 d-grid gap-2">
        <a class="btn btn-dark" href="/mobiles"><i class="fa-solid fa-mobile"></i> Mobile Phones</a>
    </div>

    <div class="col-sm-3 d-grid gap-2">
        <a class="btn btn-dark" href="/televisions"><i class="fa-solid fa-tv"></i> Televisions</a>
    </div>
</div>

<div class="row mb-3">
    <div class="col-sm-12 border-bottom py-1">
        <span class="fs-4 fw-semibold">Our Reviews</span>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <figure>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra luctus turpis, et semper dolor
                lacinia a. In a nunc at tortor rhoncus eleifend vitae eu quam. Suspendisse in blandit nisl. Cras sed
                justo dapibus, convallis sem non, tincidunt urna..</p>
            <figcaption class="blockquote-footer">
                Joe Bloggs <cite title="Source Title">London, United Kingdom</cite>
            </figcaption>
        </figure>
    </div>

    <div class="col-sm-6">
        <figure>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra luctus turpis, et semper dolor
                lacinia a. In a nunc at tortor rhoncus eleifend vitae eu quam. Suspendisse in blandit nisl. Cras sed
                justo dapibus, convallis sem non, tincidunt urna..</p>
            <figcaption class="blockquote-footer">
                Joe Bloggs <cite title="Source Title">London, United Kingdom</cite>
            </figcaption>
        </figure>
    </div>
</div>

@endsection