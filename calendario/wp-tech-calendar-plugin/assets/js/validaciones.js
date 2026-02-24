/**
 * Módulo de validaciones para el formulario de citas (Adaptado para WP sin Tailwind)
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

export function validateField(input) {
  const fieldName = input.id;
  const config = VALIDATIONS[fieldName];

  if (!config) return true;

  const isValid = config.regex.test(input.value.trim());
  const errorElement = document.getElementById(`${fieldName}Error`);

  if (!isValid) {
    input.classList.add("border-red-500");
    if (errorElement) {
      errorElement.innerText = config.message;
      errorElement.classList.remove("tc-hidden");
    }
  } else {
    input.classList.remove("border-red-500");
    if (errorElement) {
      errorElement.innerText = "";
      errorElement.classList.add("tc-hidden");
    }
  }

  return isValid;
}

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
