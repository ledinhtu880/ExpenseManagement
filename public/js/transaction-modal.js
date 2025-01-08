const MODAL_CONFIG = {
  SELECTORS: {
    FORM: '#formTransaction',
    AMOUNT: '#amount',
    CATEGORY: '#category_id',
    DATE: "#date",
    SAVE_BTN: '#saveBtn',
  },
  MESSAGES: {
    CATEGORY_REQUIRED: 'Vui lòng chọn nhóm.',
    INVALID_AMOUNT: 'Số tiền phải lớn hơn 0.',
    FUTURE_DATE: 'Ngày không được lớn hơn ngày hiện tại.'
  }
};

class TransactionFormValidator {
  static validate() {
    const amount = $(MODAL_CONFIG.SELECTORS.AMOUNT).val();
    const categoryId = $(MODAL_CONFIG.SELECTORS.CATEGORY).val();
    const dateValue = $(MODAL_CONFIG.SELECTORS.DATE).val();

    // Validate amount
    if (Number(amount) <= 0) {
      showToast(MODAL_CONFIG.MESSAGES.INVALID_AMOUNT, 'warning');
      return false;
    }

    // Validate category
    if (categoryId === 'default') {
      showToast(MODAL_CONFIG.MESSAGES.CATEGORY_REQUIRED, 'warning');
      return false;
    }

    // Validate date
    if (!this.isValidDate(dateValue)) {
      showToast(MODAL_CONFIG.MESSAGES.FUTURE_DATE, 'warning');
      return false;
    }

    return true;
  }

  static isValidDate(dateValue) {
    if (!dateValue) return false;

    const inputDate = new Date(dateValue);
    const today = new Date();

    // Reset time parts for both dates to compare only dates
    inputDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);

    // Compare timestamps
    return inputDate.getTime() <= today.getTime();
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