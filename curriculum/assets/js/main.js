/**
 * JavaScript principal
 * Cypherstudios - Víctor Visús García
 */

document.addEventListener("DOMContentLoaded", function () {
  // Variables globales
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  const backToTopBtn = document.getElementById("back-to-top");
  const navLinks = document.querySelectorAll(".nav-link");
  const contactForm = document.getElementById("contact-form");
  const mainHeader = document.getElementById("main-header");

  let lastScrollTop = 0;
  let scrollTimer = null;

  // Header dinámico al hacer scroll
  function handleHeaderScroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > 100) {
      // Scroll hacia abajo - ocultar header
      mainHeader.style.transform = "translateY(-100%)";
    } else {
      // Scroll hacia arriba o cerca del top - mostrar header
      mainHeader.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop;
  }

  // Evento de scroll con debounce
  window.addEventListener("scroll", function () {
    if (scrollTimer) {
      clearTimeout(scrollTimer);
    }
    scrollTimer = setTimeout(handleHeaderScroll, 10);
  });

  // Menú móvil
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", function () {
      mobileMenu.classList.toggle("hidden");

      // Cambiar icono del botón
      const icon = this.querySelector("svg");
      if (mobileMenu.classList.contains("hidden")) {
        icon.innerHTML =
          '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
      } else {
        icon.innerHTML =
          '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
      }
    });
  }

  // Cerrar menú móvil al hacer click en un enlace
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      if (mobileMenu && !mobileMenu.classList.contains("hidden")) {
        mobileMenu.classList.add("hidden");
        // Restaurar icono del menú
        const icon = mobileMenuBtn.querySelector("svg");
        icon.innerHTML =
          '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
      }
    });
  });

  // Volver arriba
  if (backToTopBtn) {
    window.addEventListener("scroll", function () {
      if (window.pageYOffset > 300) {
        backToTopBtn.classList.remove("opacity-0", "invisible");
        backToTopBtn.classList.add("opacity-100", "visible");
      } else {
        backToTopBtn.classList.add("opacity-0", "invisible");
        backToTopBtn.classList.remove("opacity-100", "visible");
      }
    });

    backToTopBtn.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }

  // Smooth scroll para enlaces ancla
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        const offsetTop = target.offsetTop - 100; // Más espacio para header fijo
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }
    });
  });

  // Validación de formularios
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      const name = document.getElementById("name");
      const email = document.getElementById("email");
      const subject = document.getElementById("subject");
      const message = document.getElementById("message");

      let isValid = true;
      let firstErrorField = null;

      // Validar nombre
      if (name && name.value.trim().length < 2) {
        showFieldError(name, "El nombre debe tener al menos 2 caracteres");
        isValid = false;
        if (!firstErrorField) firstErrorField = name;
      } else {
        clearFieldError(name);
      }

      // Validar email
      if (email && !isValidEmail(email.value)) {
        showFieldError(email, "El email no es válido");
        isValid = false;
        if (!firstErrorField) firstErrorField = email;
      } else {
        clearFieldError(email);
      }

      // Validar asunto
      if (subject && subject.value.trim().length < 3) {
        showFieldError(subject, "El asunto debe tener al menos 3 caracteres");
        isValid = false;
        if (!firstErrorField) firstErrorField = subject;
      } else {
        clearFieldError(subject);
      }

      // Validar mensaje
      if (message && message.value.trim().length < 10) {
        showFieldError(message, "El mensaje debe tener al menos 10 caracteres");
        isValid = false;
        if (!firstErrorField) firstErrorField = message;
      } else {
        clearFieldError(message);
      }

      if (!isValid) {
        e.preventDefault();
        firstErrorField.focus();

        // Mostrar mensaje de error general
        showNotification(
          "Por favor, corrige los errores del formulario",
          "error",
        );
      }
    });
  }

  // Animaciones al hacer scroll
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-fadeIn");
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observar elementos para animación
  document.querySelectorAll("section article, .card").forEach((el) => {
    observer.observe(el);
  });

  // Efecto parallax suave en el hero
  window.addEventListener("scroll", function () {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector("#inicio");
    if (hero) {
      hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
  });

  // Prevenir spam en emails (simple)
  document.querySelectorAll('a[href^="mailto:"]').forEach((link) => {
    link.addEventListener("click", function (e) {
      // Puedes añadir aquí protección adicional si es necesario
    });
  });
});

// Funciones auxiliares
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function showFieldError(field, message) {
  clearFieldError(field);

  field.classList.add("border-red-400");

  const errorDiv = document.createElement("div");
  errorDiv.className = "text-red-400 text-sm mt-1";
  errorDiv.textContent = message;
  errorDiv.setAttribute("data-error", "true");

  field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
  field.classList.remove("border-red-400");

  const errorDiv = field.parentNode.querySelector('[data-error="true"]');
  if (errorDiv) {
    errorDiv.remove();
  }
}

function showNotification(message, type = "info") {
  // Crear elemento de notificación
  const notification = document.createElement("div");
  notification.className = `fixed top-20 right-4 p-4 rounded-md shadow-lg z-50 max-w-sm ${
    type === "error"
      ? "bg-red-900/90 border border-red-400 text-red-300"
      : type === "success"
        ? "bg-green-900/90 border border-green-400 text-green-300"
        : "bg-blue-900/90 border border-blue-400 text-blue-300"
  }`;
  notification.textContent = message;

  document.body.appendChild(notification);

  // Animar entrada
  setTimeout(() => {
    notification.classList.add("animate-fadeIn");
  }, 100);

  // Remover después de 5 segundos
  setTimeout(() => {
    notification.style.opacity = "0";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  }, 5000);
}

// Utilidades
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Detectar preferencia de modo oscuro/claro
function detectColorScheme() {
  const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
  const prefersLight = window.matchMedia(
    "(prefers-color-scheme: light)",
  ).matches;

  if (prefersLight) {
    document.documentElement.classList.add("light-mode");
  }
}

// Inicializar detección de tema
detectColorScheme();

// Escuchar cambios en preferencia de tema
window
  .matchMedia("(prefers-color-scheme: dark)")
  .addEventListener("change", detectColorScheme);

// Prevenir doble envío de formularios
document.querySelectorAll("form").forEach((form) => {
  form.addEventListener("submit", function () {
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = "Enviando...";

      // Rehabilitar después de 5 segundos por si falla
      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = "Enviar mensaje";
      }, 5000);
    }
  });
});

// Lazy loading para imágenes (si es necesario)
if ("IntersectionObserver" in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.classList.remove("lazy");
        imageObserver.unobserve(img);
      }
    });
  });

  document.querySelectorAll("img[data-src]").forEach((img) => {
    imageObserver.observe(img);
  });
}
