import { configureStore } from "@reduxjs/toolkit";
import cartReducer from "./cart";
import productReducer from "./product";
import modalsReducer from './modals';

export default configureStore({
    reducer: {
        cart: cartReducer,
        product: productReducer,
        modals: modalsReducer
    },
});
