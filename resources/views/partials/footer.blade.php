<div class="bg-base-200 mt-auto border-t border-t-base-300 shadow">
    <footer class="footer p-10 text-base-content container mx-auto">
        <div>
            <span class="footer-title">Eparts</span>
            <a class="link link-hover" href="#">@lang('footer.eparts.about')</a>
            <a class="link link-hover" href="#">@lang('footer.eparts.contacts')</a>
            <a class="link link-hover" href="#">@lang('footer.eparts.privacy')</a>
            <a class="link link-hover" href="#">@lang('footer.eparts.terms')</a>
        </div>
        <div>
            <span class="footer-title">@lang('footer.company.title')</span>
            <a class="link link-hover" href="#">@lang('footer.company.about')</a>
            <a class="link link-hover" href="#">@lang('footer.company.contacts')</a>
        </div>
        <div>
            <span class="footer-title">@lang('footer.social.title')</span>
            <a class="link link-hover" href="#">Facebook</a>
            <a class="link link-hover" href="#">Twitter</a>
            <a class="link link-hover" href="#">Instagram</a>
        </div>
        <div>
            <span class="footer-title">@lang('footer.legal.title')</span>
            <a class="link link-hover" href="#">@lang('footer.legal.privacy')</a>
            <a class="link link-hover" href="#">@lang('footer.legal.terms')</a>
            @include('partials.language-switcher')
        </div>
    </footer>
</div>

<div class=" bg-base-200">
    <footer class="footer px-10 py-4 border-t container mx-auto text-base-content border-base-300">
        <div class="items-center grid-flow-col mx-auto">
            <p>@lang('footer.rights', ['year' => now()->year])</p>
        </div>
    </footer>
</div>
