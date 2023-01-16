module.exports = {
    extends: [
        'plugin:vue/vue3-recommended',
    ],
    rules: {
        semi: ["error", "always"],
        quotes: ["error", "single", { "avoidEscape": true }],
        indent: ["error", 2],
        "prefer-template": "error",
        "comma-dangle": ["error", "always-multiline"],
    },
}
