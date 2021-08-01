module.exports = {
    purge: [],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                "nothub-purple": "#5267DF",
                "notehub-red": "#FA5959",
                "notehub-blue": "#242A45",
                "notehub-grey": "#9194A2",
                "notehub-white": "#f7f7f7"
            }
        },
        fontFamily: {
            Merienda: ["Merienda"],
            Righteous: ["Righteous"],
            Gowun: ["Gowun Dodum"]
        },
        container: {
            center: true,
            padding: "1rem",
            screens: {
                lg: "1124px",
                xl: "1124px",
                "2xl": "1124px"
            }
        }
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
