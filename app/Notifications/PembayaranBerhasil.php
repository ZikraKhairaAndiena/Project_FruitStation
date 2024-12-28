<?php

namespace App\Notifications;

use App\Models\Pembayaran;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PembayaranBerhasil extends Notification
{
    protected $pembayaran;

    public function __construct(Pembayaran $pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }

    // Menentukan saluran pengiriman notifikasi
    public function via($notifiable)
    {
        // Hapus notifikasi lama sebelum mengirimkan notifikasi baru
        $notifiable->notifications()->delete(); // Menghapus semua notifikasi lama untuk notifiable (pengguna)

        return ['database', 'mail']; // Bisa melalui database dan email
    }

    // Isi pesan notifikasi untuk database
    public function toDatabase($notifiable)
    {
        // Ambil nama pengguna
        $userName = $this->pembayaran->pembelian->user->name; // Mengambil nama pengguna dari relasi pembelian
        $userNameForDatabase = $this->pembayaran->pembelian->user->name . ' ' . $this->pembayaran->pembelian->user->nickname; // Nama lengkap dengan nickname

        return [
            'pembayaran_id' => $this->pembayaran->id,
            'message' => 'Pembayaran untuk pembelian oleh ' . $userNameForDatabase . ' telah berhasil!',
        ];
    }

    // Isi pesan notifikasi untuk email
    public function toMail($notifiable)
    {
        // Ambil nama pengguna
        $userName = $this->pembayaran->pembelian->user->name;

        return (new MailMessage)
                    ->subject('Pembayaran Berhasil')
                    ->line('Pembayaran oleh ' . $userName . ' telah berhasil.')
                    ->action('Lihat Pembayaran', url('/admin/pembayaran/' . $this->pembayaran->id))
                    ->line('Terima kasih telah melakukan pembayaran.');
    }
}
