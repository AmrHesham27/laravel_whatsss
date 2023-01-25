import { createSlice } from "@reduxjs/toolkit";

export const modalsSlice = createSlice({
  name: "modals",
  initialState: {
    sendToWhatsapp: false,
    cartModal: false
  },
  reducers: {
    toggleSendToWhatsapp: (state) => {
      state.cartModal = false;
      state.sendToWhatsapp = !state.sendToWhatsapp;
    },
    toggleCartModal: (state) => {
      state.sendToWhatsapp = false;
      state.cartModal = !state.cartModal;
    }
    
  },
});

export const modalsActions = modalsSlice.actions;

export default modalsSlice.reducer;