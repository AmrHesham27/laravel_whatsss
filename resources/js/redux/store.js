import { configureStore } from "@reduxjs/toolkit";
import cartReducer from "./cart";
import productReducer from "./product";

export default configureStore({
    reducer: {
        cart: cartReducer,
        product: productReducer,
    },
});
