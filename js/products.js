document.addEventListener("DOMContentLoaded", () => {
    const productsGrid = document.querySelector("#products-grid");

    if (!productsGrid) {
        return;
    }

    const baseUrl = window.ATI_BASE_URL || "";
    const searchInput = document.querySelector("#product-search");
    const filtersContainer = document.querySelector("#category-filters");
    const feedback = document.querySelector("#catalog-feedback");
    const modal = document.querySelector("#product-detail-modal");
    const modalContent = document.querySelector("#product-detail-content");
    const closeModalButton = document.querySelector("#close-product-modal");

    const state = {
        search: "",
        category: "",
    };

    let searchTimeout = null;

    const currencyFormatter = new Intl.NumberFormat("es-CR", {
        style: "currency",
        currency: "CRC",
        maximumFractionDigits: 0,
    });

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function formatPrice(value) {
        return currencyFormatter.format(Number(value || 0));
    }

    function setFeedback(message, variant = "light") {
        if (!feedback) {
            return;
        }

        if (!message) {
            feedback.textContent = "";
            feedback.className = "alert alert-light border catalog-feedback visually-hidden";
            return;
        }

        feedback.textContent = message;
        feedback.className = `alert alert-${variant} border catalog-feedback is-visible`;
    }

    function setActiveCategory(category) {
        filtersContainer.querySelectorAll("[data-category]").forEach((button) => {
            const isActive = button.dataset.category === category;
            button.classList.toggle("is-active", isActive);
            button.classList.toggle("active", isActive);
        });
    }

    function renderEmptyState() {
        productsGrid.innerHTML = `
            <div class="col-12">
                <div class="catalog-empty">
                    No se encontraron productos con ese filtro.
                </div>
            </div>
        `;
    }

    function buildProductCard(product) {
        const isOutOfStock = product.estado === "agotado" || Number(product.stock) <= 0;
        const stockLabel = isOutOfStock ? "Agotado" : `Stock: ${escapeHtml(product.stock)}`;
        const stockClass = isOutOfStock ? "estado-agotado" : "estado-activo";

        return `
            <div class="col-md-4 col-lg-3">
                <div class="producto d-flex flex-column">
                    <img src="${escapeHtml(product.imagen)}" alt="${escapeHtml(product.nombre)}">
                    <p class="categoria">${escapeHtml(product.categoria)}</p>
                    <h5>${escapeHtml(product.nombre)}</h5>
                    <p class="precio">${escapeHtml(formatPrice(product.precio))}</p>
                    <span class="estado ${stockClass}">${stockLabel}</span>
                    <div class="acciones d-grid gap-2">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-action="detail" data-product-id="${escapeHtml(product.id)}">
                            Ver detalle
                        </button>
                        <button
                            type="button"
                            class="btn btn-dark btn-sm"
                            data-action="add-cart"
                            data-product-id="${escapeHtml(product.id)}"
                            ${isOutOfStock ? "disabled" : ""}>
                            ${isOutOfStock ? "Sin stock" : "Agregar al carrito"}
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    function renderProducts(products) {
        if (!Array.isArray(products) || products.length === 0) {
            renderEmptyState();
            return;
        }

        productsGrid.innerHTML = products.map(buildProductCard).join("");
    }

    async function fetchProducts() {
        const params = new URLSearchParams({
            action: "productos_json",
            search: state.search,
            category: state.category,
        });

        setFeedback("Cargando catalogo...");

        try {
            const response = await fetch(`${baseUrl}/index.php?${params.toString()}`);
            const data = await response.json();

            if (!response.ok || !data.ok) {
                throw new Error(data.message || "No fue posible cargar el catalogo.");
            }

            renderProducts(data.products || []);
            setFeedback("");
        } catch (error) {
            renderEmptyState();
            setFeedback(error.message || "Ocurrio un error al cargar el catalogo.", "danger");
        }
    }

    function openModal() {
        modal.hidden = false;
        document.body.style.overflow = "hidden";
    }

    function closeModal() {
        modal.hidden = true;
        document.body.style.overflow = "";
    }

    async function loadProductDetail(productId) {
        setFeedback("Cargando detalle...");

        try {
            const params = new URLSearchParams({
                action: "producto_detalle_json",
                id: productId,
            });

            const response = await fetch(`${baseUrl}/index.php?${params.toString()}`);
            const data = await response.json();

            if (!response.ok || !data.ok) {
                throw new Error(data.message || "No fue posible cargar el detalle.");
            }

            const product = data.product;
            const isOutOfStock = product.estado === "agotado" || Number(product.stock) <= 0;

            modalContent.innerHTML = `
                <div class="row g-4 align-items-start">
                    <div class="col-md-5">
                        <img class="product-modal__image" src="${escapeHtml(product.imagen)}" alt="${escapeHtml(product.nombre)}">
                    </div>
                    <div class="col-md-7">
                        <p class="categoria mb-2">${escapeHtml(product.categoria)}</p>
                        <h4>${escapeHtml(product.nombre)}</h4>
                        <p>${escapeHtml(product.descripcion)}</p>
                        <p class="product-modal__price mb-2">${escapeHtml(formatPrice(product.precio))}</p>
                        <p class="product-modal__stock mb-3">${isOutOfStock ? "Agotado" : `Stock disponible: ${escapeHtml(product.stock)}`}</p>
                        <button
                            type="button"
                            class="btn btn-dark"
                            data-action="add-cart"
                            data-product-id="${escapeHtml(product.id)}"
                            ${isOutOfStock ? "disabled" : ""}>
                            ${isOutOfStock ? "Sin stock" : "Agregar al carrito"}
                        </button>
                    </div>
                </div>
            `;

            openModal();
            setFeedback("");
        } catch (error) {
            setFeedback(error.message || "Ocurrio un error al cargar el detalle.", "danger");
        }
    }

    async function addToCart(productId) {
        const body = new URLSearchParams({
            action: "agregar_carrito_json",
            product_id: productId,
            quantity: "1",
        });

        try {
            const response = await fetch(`${baseUrl}/index.php`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: body.toString(),
            });

            const data = await response.json();

            if (!response.ok || !data.ok) {
                throw new Error(data.message || "No fue posible agregar el producto al carrito.");
            }

            setFeedback(data.message || "Producto agregado al carrito.", "success");
        } catch (error) {
            setFeedback(error.message || "Ocurrio un error al agregar al carrito.", "danger");
        }
    }

    if (searchInput) {
        searchInput.addEventListener("input", (event) => {
            clearTimeout(searchTimeout);
            state.search = event.target.value.trim();

            searchTimeout = window.setTimeout(() => {
                fetchProducts();
            }, 250);
        });
    }

    if (filtersContainer) {
        filtersContainer.addEventListener("click", (event) => {
            const button = event.target.closest("[data-category]");

            if (!button) {
                return;
            }

            state.category = button.dataset.category || "";
            setActiveCategory(state.category);
            fetchProducts();
        });
    }

    productsGrid.addEventListener("click", (event) => {
        const button = event.target.closest("[data-action]");

        if (!button) {
            return;
        }

        const productId = button.dataset.productId;

        if (!productId) {
            return;
        }

        if (button.dataset.action === "detail") {
            loadProductDetail(productId);
        }

        if (button.dataset.action === "add-cart") {
            addToCart(productId);
        }
    });

    modalContent.addEventListener("click", (event) => {
        const button = event.target.closest("[data-action='add-cart']");

        if (!button) {
            return;
        }

        const productId = button.dataset.productId;

        if (productId) {
            addToCart(productId);
        }
    });

    closeModalButton.addEventListener("click", closeModal);

    modal.addEventListener("click", (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && !modal.hidden) {
            closeModal();
        }
    });

    fetchProducts();
});
