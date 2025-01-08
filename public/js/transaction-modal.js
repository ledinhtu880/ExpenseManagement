const MODAL_CONFIG = {
  SELECTORS: {
    FORM: '#formTransaction',
    AMOUNT: '#amount',
    CATEGORY: '#category_id',
    SAVE_BTN: '#saveBtn',
  }
};

class TransactionFormValidator {
  static validate() {
    const amount = $(MODAL_CONFIG.SELECTORS.AMOUNT).val();
    const categoryId = $(MODAL_CONFIG.SELECTORS.CATEGORY).val();

    if (categoryId === 'default') {
      showToast('Vui lòng chọn nhóm.', 'warning');
      return false;
    }
    if (amount <= 0) {
      showToast('Số tiền phải lớn hơn 0.', 'warning');
      return false;
    }
    return true;
  }
}

$(document).ready(function () {
  // Category selection handling
  $('.category-item').click(function () {
    // Remove highlight from all categories
    $('.category-item').removeClass('active');
    // Add highlight to selected category
    $(this).addClass('active');

    const categoryId = $(this).data('category-id');
    const categoryName = $(this).data('category-name');

    // Update hidden input and button text in first modal
    $('#category_id').val(categoryId);
    $('#selectedCategoryText').text(categoryName);

    // Close category selection modal
    $('#selectCategory').modal('hide');
  });

  // When opening category modal
  $('#selectCategory').on('show.bs.modal', function () {
    const selectedCategoryId = $('#category_id').val();
    // Remove all highlights first
    $('.category-item').removeClass('active');
    // Add highlight to previously selected category if exists
    if (selectedCategoryId) {
      $(`.category-item[data-category-id="${selectedCategoryId}"]`).addClass('active');
    }
  });

  // Set up event handlers
  $(MODAL_CONFIG.SELECTORS.SAVE_BTN).click(function () {
    if (TransactionFormValidator.validate()) {
      $(MODAL_CONFIG.SELECTORS.FORM).submit();
    }
  });

});