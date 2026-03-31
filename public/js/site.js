(() => {
    const menuButton = document.querySelector(".menu-toggle");
    const nav = document.querySelector(".nav");

    if (menuButton && nav) {
        menuButton.addEventListener("click", () => {
            document.body.classList.toggle("menu-open");
        });

        nav.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                document.body.classList.remove("menu-open");
            });
        });
    }

    const nodes = document.querySelectorAll("[data-reveal]");
    if (!nodes.length) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("in-view");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.18, rootMargin: "0px 0px -30px 0px" }
    );

    nodes.forEach((node, index) => {
        node.style.transitionDelay = `${Math.min(index * 25, 220)}ms`;
        observer.observe(node);
    });
})();
