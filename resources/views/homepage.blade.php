<?php
use Prismic\Dom\RichText;
use Prismic\Dom\Link;
?>

@extends('layouts.app')

@section('content')

    <div class="homepage" data-wio-id="{!! $document->id !!}">

        <section class="homepage-banner" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url({!! $document->data->backgroundImage->url !!});">
            <div class="banner-content l-grid-container">
                <h1 class="banner-title">{!! RichText::asText($document->data->title) !!}</h1>
                {!! RichText::asHtml($document->data->tagline, $linkResolver) !!}
                <a
                    class="banner-button"
                    href="{!! Link::asUrl($document->data->buttonLink, $linkResolver) !!}"
                >
                    {!! $document->data->buttonText !!}
                </a>
            </div>
        </section>

        @foreach ($document->data->body as $slice)
            @switch ($slice->slice_type)
                @case ('highlight_section')
                    @include('partials.slices.highlight-section', ['slice' => $slice])
                    @break
                @case ('banner')
                    @include('partials.slices.banner', ['slice' => $slice])
                    @break
                @case ('banner_look')
                    @include('partials.slices.quote-banner', ['slice' => $slice])
                    @break
                @case ('editorial_look')
                    @include('partials.slices.featured-section', ['slice' => $slice])
                    @break
                @case ('text_section')
                    @include('partials.slices.text-section', ['slice' => $slice])
                    @break
                @case ('image_slider')
                    @include('partials.slices.image-slider', ['slice' => $slice])
                    @break
                @case ('gallery')
                    @include('partials.slices.gallery', ['slice' => $slice])
                    @break
                 @case ('video')
                    @include('partials.slices.video', ['slice' => $slice])
                    @break
            @endswitch
        @endforeach

    </div>

@stop