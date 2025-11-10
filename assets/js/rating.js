            document.addEventListener("DOMContentLoaded", () => {
                // Seleciona todos os blocos de estrelas (um por modal)
                document.querySelectorAll(".rating-stars-input").forEach(starsContainer => {
                    const ratingInput = starsContainer.querySelector(".rating-input-top");
                    const notaInput = starsContainer.closest("form").querySelector("input[name='nota']");
                    const starIcons = starsContainer.querySelectorAll("iconify-icon");

                    function updateStars(value) {
                        value = parseFloat(value) || 0;
                        if (value < 0 || value > 10) value = 0;

                        notaInput.value = value;
                        ratingInput.value = value;
                        const starsValue = value / 2;

                        starIcons.forEach((star, index) => {
                            const starNumber = index + 1;
                            const diferenca = starsValue - (starNumber - 1);
                            if (diferenca >= 1) {
                                star.setAttribute("icon", "ic:round-star");
                            } else if (diferenca >= 0.5) {
                                star.setAttribute("icon", "ic:round-star-half");
                            } else {
                                star.setAttribute("icon", "ic:round-star-border");
                            }
                        });
                    }

                    ratingInput.addEventListener("input", () => updateStars(ratingInput.value));
                    ratingInput.addEventListener("blur", () => updateStars(ratingInput.value));
                    updateStars(0);
                });
            });