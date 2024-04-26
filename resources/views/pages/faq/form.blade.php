<x-page.form
        title="{{ $faq->exists ? __('Update :name', ['name' => __(config('admix-faqs.name'))]) : __('Create :name', ['name' => __(config('admix-faqs.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label for="form.is_active">
                {{ str(__('admix-faqs::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle name="form.is_active"
                           :large="true"
                           :label-on="__('Yes')"
                           :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input name="form.name" :label="__('admix-faqs::fields.name')"/>
        </div>
        <div class="col-md-6 mb-3">
            <!-- input here -->
        </div>
        <div class="col-md-12 mb-3">
            <x-form.easymde name="form.description" :label="__('admix-faqs::fields.description')"/>
        </div>
        <div class="col-md-6 mb-3">
            <x-form.number name="form.sort" :label="__('admix-faqs::fields.sort')"/>
        </div>
    </div>

    <x-slot:complement>
        @if($faq->exists)
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.id')"
                                  :value="$faq->id"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.slug')"
                                  :value="$faq->slug"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.created_at')"
                                  :value="$faq->created_at->format(config('admix.timestamp.format'))"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.updated_at')"
                                  :value="$faq->updated_at->format(config('admix.timestamp.format'))"/>
            </div>
        @endif
    </x-slot:complement>
</x-page.form>
