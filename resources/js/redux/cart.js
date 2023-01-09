import { createSlice } from "@reduxjs/toolkit";

export const cartSlice = createSlice({
  name: "cart",
  initialState: {
    itemsCount: 0,
    items: {},
    total: 0,
  },
  reducers: {
    addProduct: (state, action) => {
      let product = action.payload;

      if (!state.items[product.name]) {
        state.itemsCount++;
        let newProduct = {...product, qty: 1}
        state.items[newProduct["name"]] = newProduct;
        state.total += newProduct["price"];
      }
      else {
        state.itemsCount++;
        state.total += product["price"];
        state.items[product.name]['qty']++
      }
    },
    removeProduct: (state, action) => {
      let productName = action.payload;

      if (state.items[productName]) {
        state.itemsCount = state.itemsCount - state.items[productName]["qty"];
        state.total -=
          state.items[productName]["qty"] * state.items[productName]["price"];
        delete state.items[productName];
      }
    },
    decreaseProductQty: (state, action) => {
      let productName = action.payload;

      state.total -= state["items"][productName]["price"];

      if (state.items[productName].qty === 1) {
        delete state.items[productName];
      } else {
        state.items[productName].qty--;
      }
      state.itemsCount--;
    },
    increaseProductQty: (state, action) => {
      let productName = action.payload;

      state.items[productName].qty++;
      state.itemsCount++;
      state.total += state["items"][productName]["price"];
    },
    setCart: (state, action) => {
      state.itemsCount = action.payload["itemsCount"];
      state.items = action.payload["items"];
      state.total = action.payload["total"];
    },
  },
});

export const cartActions = cartSlice.actions;

export default cartSlice.reducer;