/**
 * Módulo de validaciones para el formulario de citas
 */

const VALIDATIONS = {
  fullName: {
    regex: /^[a-zA-ZÀ-ÿ\s]{3,40}$/,
    message:
      "El nombre debe tener al menos 3 letras y solo contener caracteres alfabéticos.",
  },
  phone: {
    regex: /^(?:\+34|0034)?[6789]\d{8}$/,
    message: "Introduce un número de teléfono válido (9 dígitos).",
  },
  email: {
    regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
    message: "Introduce un formato de email válido.",
  },
};

/**
 * Valida un campo individual y muestra/oculta el error
 * @param {HTMLInputElement} input
 * @returns {boolean}
 */
export function validateField(input) {
  const fieldName = input.id;
  const config = VALIDATIONS[fieldName];

  if (!config) return true; // Si no hay regla, es válido (ej. comentarios)

  const isValid = config.regex.test(input.value.trim());
  const errorElement = document.getElementById(`${fieldName}Error`);

  if (!isValid) {
    input.classList.add("border-red-500", "focus:border-red-500");
    input.classList.remove("border-border-base", "focus:border-accent");
    if (errorElement) {
      errorElement.innerText = config.message;
      errorElement.classList.remove("hidden");
    }
  } else {
    input.classList.remove("border-red-500", "focus:border-red-500");
    input.classList.add("border-border-base", "focus:border-accent");
    if (errorElement) {
      errorElement.innerText = "";
      errorElement.classList.add("hidden");
    }
  }

  return isValid;
}

/**
 * Valida todos los campos necesarios del formulario
 * @param {HTMLFormElement} form
 * @returns {boolean}
 */
export function validateForm(form) {
  const fields = ["fullName", "phone", "email"];
  let isAllValid = true;

  fields.forEach((fieldId) => {
    const input = document.getElementById(fieldId);
    if (input && !validateField(input)) {
      isAllValid = false;
    }
  });

  return isAllValid;
}
