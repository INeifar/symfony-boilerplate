<?php

/*
 * This file is part of Symfony Boilerplate.
 *
 * (c) Saif Eddin Gmati
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Mail;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

final class PasswordResetEmail extends TemplatedEmail
{
    private const Subject = 'Password Reset';

    private const Template = 'user/reset_password/email.html.twig';

    public static function create(User $receiver, array $context = []): PasswordResetEmail
    {
        /** @var string $receiverEmail */
        $receiverEmail = $receiver->getEmail();
        $receiverName = $receiver->getUsername();

        $email = new self();
        $email
            ->to(new Address($receiverEmail, $receiverName))
            ->subject(self::Subject)
            ->htmlTemplate(self::Template)
            ->context($context);

        return $email;
    }
}
