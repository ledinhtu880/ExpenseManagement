@props(['user', 'groupTypes', 'categories'])

<button type="button"
    class="btn btn-primary-color text-white rounded-circle d-flex align-items-center justify-content-center"
    data-bs-toggle="modal" data-bs-target="#addTransaction"
    style="position: fixed; bottom: 30px; right: 30px; z-index: 999; width: 60px; height: 60px;">
    <i class="fa-solid fa-plus" style="font-size: 24px;"></i>
</button>

<!-- First modal - Transaction form -->
<div class="modal fade" id="addTransaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addTransactionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-primary-color fw-bold fs-5 m-0" id="addTransactionLabel">Thêm giao dịch</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Transaction form content -->
                @include('components.transaction-form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary-color" id="saveBtn">Lưu</button>
            </div>
        </div>
    </div>
</div>

<!-- Second modal - Category selection -->
<div class="modal fade" id="selectCategory" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="selectCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Category selection content -->
            @include('components.category-selector')
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/transaction-modal.js') }}"></script>
@endpush
